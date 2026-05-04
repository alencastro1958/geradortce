<?php
namespace App\Http\Controllers;

use App\Models\Estagio;
use App\Models\Relatorio;
use App\Models\SupervisorEstagio;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupervisorPortalController extends Controller
{
    // ─── Login ───────────────────────────────────────────────

    public function loginForm()
    {
        if (Auth::check() && Auth::user()->hasRole('supervisor')) {
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
            if (Auth::user()->hasRole('supervisor')) {
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

        $estagios = Estagio::with(['estagiario', 'relatorios'])
            ->where('supervisor_estagio_id', $supervisor->id)
            ->where('status', 'ativo')
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

        $validated = $request->validate([
            'semestre'    => 'required|integer|min:1|max:4',
            'avaliacao'   => 'required|in:excelente,bom,regular,insuficiente',
            'observacoes' => 'nullable|string|max:200',
            'finalizar'   => 'nullable|boolean',
        ]);

        $status = $request->boolean('finalizar') ? 'finalizado' : 'rascunho';

        $relatorio = Relatorio::updateOrCreate(
            ['estagio_id' => $estagio->id, 'semestre' => $validated['semestre']],
            [
                'supervisor_estagio_id' => $supervisor->id,
                'avaliacao'             => $validated['avaliacao'],
                'observacoes'           => $validated['observacoes'] ?? null,
                'status'                => $status,
                'gerado_em'             => $status === 'finalizado' ? now() : null,
            ]
        );

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

        $validated = $request->validate([
            'semestre'    => 'required|integer|min:1|max:4',
            'avaliacao'   => 'required|in:excelente,bom,regular,insuficiente',
            'observacoes' => 'nullable|string|max:200',
            'finalizar'   => 'nullable|boolean',
        ]);

        $status = $request->boolean('finalizar') ? 'finalizado' : 'rascunho';

        $relatorio->update([
            'semestre'    => $validated['semestre'],
            'avaliacao'   => $validated['avaliacao'],
            'observacoes' => $validated['observacoes'] ?? null,
            'status'      => $status,
            'gerado_em'   => $status === 'finalizado' ? now() : null,
        ]);

        return redirect()->route('supervisor.dashboard')
            ->with('success', 'Relatório atualizado com sucesso.');
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

        return back()->with('success', 'Acesso criado para ' . $supervisor->nome . '. Login: ' . $supervisor->email);
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
        abort_if($estagio->supervisor_estagio_id !== $supervisor->id, 403, 'Acesso não autorizado a este estágio.');
    }
}
