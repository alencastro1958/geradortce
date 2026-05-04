<?php

namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmpresaPortalController extends Controller
{
    public function loginForm(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user instanceof User && $user->hasRole('Empresa')) {
            return redirect()->route('empresa.dashboard');
        }

        return view('empresa.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'O e-mail e obrigatorio.',
            'password.required' => 'A senha e obrigatoria.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $user = Auth::user();

            if ($user instanceof User && $user->hasRole('Empresa')) {
                $request->session()->regenerate();

                return redirect()->route('empresa.dashboard');
            }

            Auth::logout();

            return back()->withErrors(['email' => 'Acesso nao autorizado para este usuario.']);
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('empresa.login');
    }

    public function dashboard(): View
    {
        $empresa = $this->empresaAutenticada()->load(['vagas' => function ($query) {
            $query->withCount('candidaturas')->latest();
        }]);

        $vagas = $empresa->vagas;
        $vagasAtivas = $vagas->where('ativa', true)->count();
        $totalCandidaturas = $vagas->sum('candidaturas_count');

        return view('empresa.dashboard', compact('empresa', 'vagas', 'vagasAtivas', 'totalCandidaturas'));
    }

    public function createVaga(): View
    {
        $empresa = $this->empresaAutenticada();
        $vaga = new Vaga([
            'nome_empresa' => $empresa->razao_social,
            'cnpj_empresa' => $empresa->cnpj,
            'ramo_empresa' => $empresa->ramo_atividade,
            'descricao_empresa' => $empresa->observacoes,
            'endereco_empresa' => $empresa->endereco,
            'contato_empresa' => $empresa->contato_nome ?: $empresa->responsavel_legal_nome,
            'email_empresa' => $empresa->email,
            'telefone_empresa' => $empresa->telefone,
            'quantidade' => 1,
            'modalidade' => 'Presencial',
            'horas_dia' => '6',
            'dias' => 'Segunda a Sexta',
            'contratacao_tipo' => 'Nao obrigatorio',
            'ativa' => true,
        ]);

        return view('empresa.vagas.form', [
            'empresa' => $empresa,
            'vaga' => $vaga,
            'route' => route('empresa.vagas.store'),
            'method' => 'POST',
            'submitLabel' => 'Publicar vaga',
            'pageTitle' => 'Cadastro de Vagas',
            'pageSubtitle' => 'Preencha as informacoes da oportunidade de estagio.',
        ]);
    }

    public function storeVaga(Request $request): RedirectResponse
    {
        $empresa = $this->empresaAutenticada();
        $validated = $this->validarVaga($request);

        $vaga = new Vaga($this->normalizarDadosVaga($validated));
        $vaga->preencherDadosDaEmpresa($empresa);
        $vaga->save();

        return redirect()->route('empresa.dashboard')->with('success', 'Vaga cadastrada com sucesso.');
    }

    public function editVaga(Vaga $vaga): View
    {
        $empresa = $this->empresaAutenticada();
        $this->autorizarVaga($vaga, $empresa);

        return view('empresa.vagas.form', [
            'empresa' => $empresa,
            'vaga' => $vaga,
            'route' => route('empresa.vagas.update', $vaga),
            'method' => 'PUT',
            'submitLabel' => 'Salvar alteracoes',
            'pageTitle' => 'Editar vaga',
            'pageSubtitle' => 'Atualize os dados do cadastro da vaga.',
        ]);
    }

    public function updateVaga(Request $request, Vaga $vaga): RedirectResponse
    {
        $empresa = $this->empresaAutenticada();
        $this->autorizarVaga($vaga, $empresa);

        $validated = $this->validarVaga($request);
        $vaga->fill($this->normalizarDadosVaga($validated));
        $vaga->preencherDadosDaEmpresa($empresa);
        $vaga->save();

        return redirect()->route('empresa.dashboard')->with('success', 'Vaga atualizada com sucesso.');
    }

    public function destroyVaga(Vaga $vaga): RedirectResponse
    {
        $empresa = $this->empresaAutenticada();
        $this->autorizarVaga($vaga, $empresa);
        $vaga->delete();

        return redirect()->route('empresa.dashboard')->with('success', 'Vaga removida com sucesso.');
    }

    public function criarAcesso(Request $request, EmpresaConcedente $empresa): RedirectResponse
    {
        if ($empresa->user_id) {
            return back()->with('error', 'Esta empresa ja possui acesso ao portal.');
        }

        if (!$empresa->email) {
            return back()->with('error', 'A empresa precisa ter um e-mail cadastrado antes de criar o acesso.');
        }

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $empresa->nome_fantasia ?: $empresa->razao_social,
            'email' => $empresa->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Empresa');

        $empresa->update(['user_id' => $user->id]);

        return back()->with('success', 'Acesso criado para a empresa. Login: ' . $empresa->email);
    }

    public function revogarAcesso(EmpresaConcedente $empresa): RedirectResponse
    {
        if ($empresa->user_id) {
            $user = User::find($empresa->user_id);
            $empresa->update(['user_id' => null]);
            $user?->delete();
        }

        return back()->with('success', 'Acesso da empresa revogado com sucesso.');
    }

    private function empresaAutenticada(): EmpresaConcedente
    {
        $empresa = Auth::user()?->empresaConcedente;

        abort_if(!$empresa, 403, 'Empresa nao vinculada ao portal.');

        return $empresa;
    }

    private function autorizarVaga(Vaga $vaga, EmpresaConcedente $empresa): void
    {
        abort_if($vaga->empresa_id !== $empresa->id, 403, 'Acesso nao autorizado a esta vaga.');
    }

    private function validarVaga(Request $request): array
    {
        return $request->validate([
            'nome_empresa' => ['required', 'string', 'max:255'],
            'cnpj_empresa' => ['required', 'string', 'max:32'],
            'ramo_empresa' => ['nullable', 'string', 'max:255'],
            'descricao_empresa' => ['nullable', 'string'],
            'endereco_empresa' => ['nullable', 'string', 'max:255'],
            'contato_empresa' => ['nullable', 'string', 'max:255'],
            'email_empresa' => ['nullable', 'email', 'max:255'],
            'telefone_empresa' => ['nullable', 'string', 'max:50'],
            'titulo' => ['required', 'string', 'max:255'],
            'area_atuacao' => ['required', 'string', 'max:255'],
            'quantidade' => ['required', 'integer', 'min:1', 'max:999'],
            'modalidade' => ['required', Rule::in(['Presencial', 'Hibrido', 'Remoto'])],
            'cidade_estado' => ['nullable', 'string', 'max:255'],
            'inicio_previsto' => ['nullable', 'date'],
            'formacao_aceita' => ['nullable', 'string'],
            'cursos' => ['nullable', 'string'],
            'periodo_minimo' => ['nullable', 'string', 'max:255'],
            'conhecimentos_desejaveis' => ['nullable', 'string'],
            'competencias' => ['nullable', 'string'],
            'atividades' => ['nullable', 'string'],
            'horas_dia' => ['nullable', 'string', 'max:50'],
            'dias' => ['nullable', 'string', 'max:255'],
            'horario' => ['nullable', 'string', 'max:255'],
            'flexibilidade' => ['nullable', 'string', 'max:255'],
            'bolsa_auxilio' => ['nullable', 'numeric', 'min:0'],
            'transporte' => ['nullable', 'string', 'max:255'],
            'alimentacao' => ['nullable', 'string', 'max:255'],
            'seguro' => ['nullable', 'string', 'max:255'],
            'outros_beneficios' => ['nullable', 'string'],
            'contratacao_tipo' => ['required', Rule::in(['Obrigatorio', 'Nao obrigatorio'])],
            'duracao' => ['nullable', 'string', 'max:255'],
            'possibilidade_efetivacao' => ['nullable', 'string', 'max:255'],
            'etapas' => ['nullable', 'string'],
            'prazo' => ['nullable', 'date'],
            'retorno' => ['nullable', 'string'],
            'link_candidatura' => ['nullable', 'url', 'max:255'],
            'email_candidatura' => ['nullable', 'email', 'max:255'],
            'instrucoes_candidatura' => ['nullable', 'string'],
            'observacoes' => ['nullable', 'string'],
            'ativa' => ['nullable', 'boolean'],
        ]);
    }

    private function normalizarDadosVaga(array $validated): array
    {
        $validated['ativa'] = (bool) ($validated['ativa'] ?? true);
        $validated['descricao'] = $validated['atividades'] ?: ($validated['descricao_empresa'] ?: $validated['titulo']);

        return $validated;
    }
}