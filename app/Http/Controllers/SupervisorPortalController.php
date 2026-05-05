<?php
namespace App\Http\Controllers;

use App\Mail\AcessoSupervisorMail;
use App\Models\Estagio;
use App\Models\Relatorio;
use App\Models\SupervisorEstagio;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SupervisorPortalController extends Controller
{
    // ─── Login ───────────────────────────────────────────────

    public function loginForm()
    {
        $user = Auth::user();
        if ($user instanceof User && $user->hasRole('supervisor')) {
            return redirect()->route('supervisor.dashboard');
        }
        return view('supervisor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $user = Auth::user();
            if ($user instanceof User && $user->hasRole('supervisor')) {
                $request->session()->regenerate();
                return redirect()->route('supervisor.dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Acesso não autorizado para este usuário.']);
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('supervisor.login');
    }

    // ─── Dashboard ───────────────────────────────────────────

    public function dashboard()
    {
        $supervisor = Auth::user()->supervisorEstagio;
        if (!$supervisor) {
            abort(403, 'Supervisor não vinculado.');
        }

        // Busca todos os estágios da empresa do supervisor (ou vinculados diretamente)
        // excluindo apenas rescindidos/concluídos
        $estagios = Estagio::with(['estagiario', 'relatorios'])
            ->where(function ($q) use ($supervisor) {
                $q->where('supervisor_estagio_id', $supervisor->id)
                  ->orWhere('empresa_concedente_id', $supervisor->empresa_concedente_id);
            })
            ->whereNotIn('status', ['rescindido', 'concluido'])
            ->get();

        return view('supervisor.dashboard', compact('supervisor', 'estagios'));
    }

    // ─── Novo Relatório ──────────────────────────────────────

    public function criarRelatorio(Estagio $estagio)
    {
        $supervisor = Auth::user()->supervisorEstagio;
        $this->autorizarEstagio($estagio, $supervisor);

        $semestresUsados = $estagio->relatorios->pluck('semestre')->toArray();

        return view('supervisor.relatorio.criar', compact('estagio', 'supervisor', 'semestresUsados'));
    }

    public function salvarRelatorio(Request $request, Estagio $estagio)
    {
        $supervisor = Auth::user()->supervisorEstagio;
        $this->autorizarEstagio($estagio, $supervisor);

        $validated = $request->validate($this->regrasValidacao());
        $status = $request->boolean('finalizar') ? 'finalizado' : 'rascunho';

        $dados = $this->montarDados($validated, $supervisor->id, $status);

        $relatorio = Relatorio::updateOrCreate(
            ['estagio_id' => $estagio->id, 'semestre' => $validated['semestre']],
            $dados
        );

        if ($status === 'finalizado') {
            return redirect()->route('supervisor.relatorio.pdf', $relatorio)
                ->with('success', 'Relatório do ' . $relatorio->labelSemestre() . ' finalizado.');
        }

        return redirect()->route('supervisor.dashboard')
            ->with('success', 'Relatório do ' . $relatorio->labelSemestre() . ' salvo com sucesso.');
    }

    public function editarRelatorio(Relatorio $relatorio)
    {
        $supervisor = Auth::user()->supervisorEstagio;
        abort_if($relatorio->supervisor_estagio_id !== $supervisor->id, 403);

        $estagio = $relatorio->estagio->load(['estagiario', 'empresaConcedente']);
        $semestresUsados = $estagio->relatorios->where('id', '!=', $relatorio->id)->pluck('semestre')->toArray();

        return view('supervisor.relatorio.editar', compact('relatorio', 'estagio', 'supervisor', 'semestresUsados'));
    }

    public function atualizarRelatorio(Request $request, Relatorio $relatorio)
    {
        $supervisor = Auth::user()->supervisorEstagio;
        abort_if($relatorio->supervisor_estagio_id !== $supervisor->id, 403);

        $validated = $request->validate($this->regrasValidacao());
        $status = $request->boolean('finalizar') ? 'finalizado' : 'rascunho';

        $relatorio->update($this->montarDados($validated, $supervisor->id, $status));

        if ($status === 'finalizado') {
            return redirect()->route('supervisor.relatorio.pdf', $relatorio)
                ->with('success', 'Relatório atualizado e finalizado.');
        }

        return redirect()->route('supervisor.dashboard')
            ->with('success', 'Relatório atualizado com sucesso.');
    }

    // ─── Helpers de validação / montagem ─────────────────────────────────────

    private function regrasValidacao(): array
    {
        $escala = 'nullable|in:insuficiente,regular,bom,otimo,excelente';
        return [
            'semestre'               => 'required|integer|min:1|max:4',
            'data_inicio_periodo'    => 'nullable|date',
            'data_fim_periodo'       => 'nullable|date|after_or_equal:data_inicio_periodo',
            'atividades_descricao'   => 'nullable|string|max:3000',
            'relacao_curso'          => 'nullable|string|max:1000',
            'comp_pontualidade'      => $escala,
            'comp_iniciativa'        => $escala,
            'comp_trabalho_equipe'   => $escala,
            'comp_qualidade_tecnica' => $escala,
            'comp_relacionamento'    => $escala,
            'comp_etica_sigilo'      => $escala,
            'parecer_descritivo'     => 'nullable|string|max:2000',
            'avaliacao'              => 'required|in:excelente,bom,regular,insuficiente',
            'horas_previstas'        => 'nullable|integer|min:0|max:9999',
            'horas_cumpridas'        => 'nullable|integer|min:0|max:9999',
            'faltas_justificadas'    => 'nullable|string|max:50',
            'faltas_nao_justificadas'=> 'nullable|string|max:50',
            'obs_ausencias'          => 'nullable|string|max:1000',
            'observacoes'            => 'nullable|string|max:200',
            'finalizar'              => 'nullable|boolean',
        ];
    }

    private function montarDados(array $validated, int $supervisorId, string $status): array
    {
        return [
            'supervisor_estagio_id'  => $supervisorId,
            'semestre'               => $validated['semestre'],
            'data_inicio_periodo'    => $validated['data_inicio_periodo'] ?? null,
            'data_fim_periodo'       => $validated['data_fim_periodo'] ?? null,
            'atividades_descricao'   => $validated['atividades_descricao'] ?? null,
            'relacao_curso'          => $validated['relacao_curso'] ?? null,
            'comp_pontualidade'      => $validated['comp_pontualidade'] ?? null,
            'comp_iniciativa'        => $validated['comp_iniciativa'] ?? null,
            'comp_trabalho_equipe'   => $validated['comp_trabalho_equipe'] ?? null,
            'comp_qualidade_tecnica' => $validated['comp_qualidade_tecnica'] ?? null,
            'comp_relacionamento'    => $validated['comp_relacionamento'] ?? null,
            'comp_etica_sigilo'      => $validated['comp_etica_sigilo'] ?? null,
            'parecer_descritivo'     => $validated['parecer_descritivo'] ?? null,
            'avaliacao'              => $validated['avaliacao'],
            'horas_previstas'        => $validated['horas_previstas'] ?? null,
            'horas_cumpridas'        => $validated['horas_cumpridas'] ?? null,
            'faltas_justificadas'    => $validated['faltas_justificadas'] ?? null,
            'faltas_nao_justificadas'=> $validated['faltas_nao_justificadas'] ?? null,
            'obs_ausencias'          => $validated['obs_ausencias'] ?? null,
            'observacoes'            => $validated['observacoes'] ?? null,
            'status'                 => $status,
            'gerado_em'              => $status === 'finalizado' ? now() : null,
        ];
    }

    public function gerarPdf(Relatorio $relatorio)
    {
        $supervisor = Auth::user()->supervisorEstagio;
        abort_if($relatorio->supervisor_estagio_id !== $supervisor->id, 403);

        $estagio = $relatorio->estagio->load(['estagiario', 'empresaConcedente', 'instituicaoEnsino']);

        $pdf = Pdf::loadView('documentos.relatorio', compact('estagio', 'relatorio'));
        $nome = 'RELATORIO_' . $relatorio->semestre . 'SEM_' . $estagio->estagiario->cpf . '_' . now()->format('YmdHis') . '.pdf';

        return $pdf->setPaper('a4')->stream($nome);
    }

    // ─── Admin: Criar acesso para supervisor ─────────────────

    public function criarAcesso(Request $request, SupervisorEstagio $supervisor)
    {
        if ($supervisor->user_id) {
            return back()->with('error', 'Este supervisor já possui acesso ao sistema.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $supervisor->nome,
            'email'    => $supervisor->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('supervisor');

        $supervisor->update(['user_id' => $user->id]);

        // Notifica o supervisor por e-mail com as credenciais de acesso
        try {
            $supervisor->loadMissing('empresaConcedente');
            Mail::to($supervisor->email)
                ->send(new AcessoSupervisorMail($supervisor, $request->password));
            $avisoEmail = ' Um e-mail com as instruções de acesso foi enviado para ' . $supervisor->email . '.';
        } catch (\Throwable $e) {
            $avisoEmail = ' (Aviso: não foi possível enviar o e-mail de boas-vindas.)';
        }

        return back()->with('success', 'Acesso criado para ' . $supervisor->nome . '. Login: ' . $supervisor->email . $avisoEmail);
    }

    public function revogarAcesso(SupervisorEstagio $supervisor)
    {
        if ($supervisor->user_id) {
            $user = User::find($supervisor->user_id);
            $supervisor->update(['user_id' => null]);
            $user?->delete();
        }
        return back()->with('success', 'Acesso revogado com sucesso.');
    }

    // ─── Helpers ─────────────────────────────────────────────

    private function autorizarEstagio(Estagio $estagio, ?SupervisorEstagio $supervisor): void
    {
        abort_if(!$supervisor, 403, 'Supervisor não vinculado ao sistema.');
        $vinculado = $estagio->supervisor_estagio_id === $supervisor->id
            || $estagio->empresa_concedente_id === $supervisor->empresa_concedente_id;
        abort_if(!$vinculado, 403, 'Acesso não autorizado a este estágio.');
    }
}
