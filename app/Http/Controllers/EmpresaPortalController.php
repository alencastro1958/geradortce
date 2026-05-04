<?php

namespace App\Http\Controllers;

use App\Models\EmpresaConcedente;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmpresaPortalController extends Controller
{
    private const SLUGS_RESERVADOS = [
        'dashboard', 'profile', 'instituicoes', 'empresas', 'estagiarios',
        'seguradoras', 'agente-integracao', 'estagios', 'api', 'vagas',
        'empresa', 'supervisor', 'representantes', 'login', 'logout',
        'register', 'forgot-password', 'reset-password', 'verify-email',
        'password', 'sanctum', 'storage', 'public', 'admin',
    ];

    public function loginForm(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user instanceof User && $user->hasRole('Empresa')) {
            $empresa = $user->empresaConcedente;
            if ($empresa?->slug) {
                return redirect('/' . $empresa->slug . '/dashboard');
            }
        }
        return view('empresa.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'O e-mail e obrigatorio.',
            'password.required' => 'A senha e obrigatoria.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $user = Auth::user();
            if ($user instanceof User && $user->hasRole('Empresa')) {
                $empresa = $user->empresaConcedente;
                if (!$empresa?->slug) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Portal nao configurado. Solicite ao administrador que defina o endereco (slug) desta empresa.']);
                }
                $request->session()->regenerate();
                return redirect('/' . $empresa->slug . '/dashboard');
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

    public function dashboard(string $slug): View
    {
        $empresa = $this->empresaAutenticadaPorSlug($slug);
        $empresa->load(['vagas' => function ($query) {
            $query->withCount('candidaturas')->latest();
        }]);
        $vagas             = $empresa->vagas;
        $vagasAtivas       = $vagas->where('ativa', true)->count();
        $totalCandidaturas = $vagas->sum('candidaturas_count');
        return view('empresa.dashboard', compact('empresa', 'vagas', 'vagasAtivas', 'totalCandidaturas'));
    }

    public function createVaga(string $slug): View
    {
        $empresa = $this->empresaAutenticadaPorSlug($slug);
        $vaga = new Vaga([
            'nome_empresa'     => $empresa->razao_social,
            'cnpj_empresa'     => $empresa->cnpj,
            'descricao_empresa'=> $empresa->observacoes,
            'endereco_empresa' => $empresa->endereco,
            'contato_empresa'  => $empresa->contato_nome ?: $empresa->responsavel_legal_nome,
            'email_empresa'    => $empresa->email,
            'telefone_empresa' => $empresa->telefone,
            'quantidade'       => 1,
            'modalidade'       => 'Presencial',
            'horas_dia'        => '6',
            'dias'             => 'Segunda a Sexta',
            'contratacao_tipo' => 'Nao obrigatorio',
            'ativa'            => true,
        ]);
        return view('empresa.vagas.form', [
            'empresa'      => $empresa,
            'vaga'         => $vaga,
            'route'        => route('empresa.vagas.store', ['slug' => $slug]),
            'method'       => 'POST',
            'submitLabel'  => 'Publicar vaga',
            'pageTitle'    => 'Cadastro de Vagas',
            'pageSubtitle' => 'Preencha as informacoes da oportunidade de estagio.',
        ]);
    }

    public function storeVaga(Request $request, string $slug): RedirectResponse
    {
        $empresa  = $this->empresaAutenticadaPorSlug($slug);
        $validated = $this->validarVaga($request);
        $vaga = new Vaga($this->normalizarDadosVaga($validated));
        $vaga->preencherDadosDaEmpresa($empresa);
        $vaga->save();
        return redirect('/' . $slug . '/dashboard')
            ->with('success', 'Vaga publicada com sucesso! Candidatos podem encontra-la em: ' . url('/vagas/oportunidades'));
    }

    public function editVaga(string $slug, Vaga $vaga): View
    {
        $empresa = $this->empresaAutenticadaPorSlug($slug);
        $this->autorizarVaga($vaga, $empresa);
        return view('empresa.vagas.form', [
            'empresa'      => $empresa,
            'vaga'         => $vaga,
            'route'        => route('empresa.vagas.update', ['slug' => $slug, 'vaga' => $vaga]),
            'method'       => 'PUT',
            'submitLabel'  => 'Salvar alteracoes',
            'pageTitle'    => 'Editar Vaga',
            'pageSubtitle' => 'Atualize os dados do cadastro da vaga.',
        ]);
    }

    public function updateVaga(Request $request, string $slug, Vaga $vaga): RedirectResponse
    {
        $empresa = $this->empresaAutenticadaPorSlug($slug);
        $this->autorizarVaga($vaga, $empresa);
        $vaga->fill($this->normalizarDadosVaga($this->validarVaga($request)));
        $vaga->preencherDadosDaEmpresa($empresa);
        $vaga->save();
        return redirect('/' . $slug . '/dashboard')->with('success', 'Vaga atualizada com sucesso.');
    }

    public function destroyVaga(Request $request, string $slug, Vaga $vaga): RedirectResponse
    {
        $empresa = $this->empresaAutenticadaPorSlug($slug);
        $this->autorizarVaga($vaga, $empresa);
        $vaga->delete();
        return redirect('/' . $slug . '/dashboard')->with('success', 'Vaga removida com sucesso.');
    }

    public function criarAcesso(Request $request, EmpresaConcedente $empresa): RedirectResponse
    {
        if ($empresa->user_id) {
            return back()->with('error', 'Esta empresa ja possui acesso ao portal.');
        }
        $request->validate([
            'slug' => [
                'required', 'string', 'min:2', 'max:100',
                'regex:/^[a-zA-Z][a-zA-Z0-9\-]*$/',
                'unique:empresa_concedentes,slug',
                Rule::notIn(self::SLUGS_RESERVADOS),
            ],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'slug.required' => 'O identificador de endereco e obrigatorio.',
            'slug.regex'    => 'O identificador deve comecar com letra e conter apenas letras, numeros e hifens.',
            'slug.unique'   => 'Este identificador ja esta sendo usado por outra empresa.',
            'slug.not_in'   => 'Este identificador e reservado pelo sistema. Escolha outro.',
        ]);
        $user = User::create([
            'name'     => $empresa->nome_fantasia ?: $empresa->razao_social,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Empresa');
        $empresa->update([
            'user_id' => $user->id,
            'email'   => $request->email,
            'slug'    => $request->slug,
        ]);
        $url = url('/' . $request->slug . '/dashboard');
        return back()->with('success', "Acesso criado! Login: {$request->email} | Portal: {$url}");
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

    public function alterarSenha(Request $request, EmpresaConcedente $empresa): RedirectResponse
    {
        $request->validate([
            'nova_senha'              => ['required', 'string', 'min:8', 'confirmed'],
            'nova_senha_confirmation' => ['required', 'string'],
        ], [
            'nova_senha.required'   => 'A nova senha e obrigatoria.',
            'nova_senha.min'        => 'A senha deve ter pelo menos 8 caracteres.',
            'nova_senha.confirmed'  => 'A confirmacao da senha nao confere.',
        ]);

        $user = $empresa->user_id ? User::find($empresa->user_id) : null;

        abort_if(!$user, 404, 'Usuario do portal nao encontrado.');

        $user->update(['password' => Hash::make($request->nova_senha)]);

        return back()->with('success', 'Senha do portal da empresa alterada com sucesso.');
    }

    public function alterarSlug(Request $request, EmpresaConcedente $empresa): RedirectResponse
    {
        $request->validate([
            'slug' => [
                'required', 'string', 'min:2', 'max:100',
                'regex:/^[a-zA-Z][a-zA-Z0-9\-]*$/',
                Rule::unique('empresa_concedentes', 'slug')->ignore($empresa->id),
                Rule::notIn(self::SLUGS_RESERVADOS),
            ],
        ], [
            'slug.required' => 'O identificador (slug) e obrigatorio.',
            'slug.regex'    => 'Use apenas letras, numeros e hifens. Deve iniciar com letra.',
            'slug.unique'   => 'Este identificador ja esta em uso por outra empresa.',
            'slug.not_in'   => 'Este identificador e reservado pelo sistema.',
        ]);

        $empresa->update(['slug' => $request->slug]);

        return back()->with('success', 'Endereco do portal definido: /' . $request->slug . '/dashboard');
    }

    private function empresaAutenticadaPorSlug(string $slug): EmpresaConcedente
    {
        $empresa = Auth::user()?->empresaConcedente;
        abort_if(!$empresa, 403, 'Empresa nao vinculada ao portal.');
        abort_if($empresa->slug !== $slug, 403, 'Acesso nao autorizado.');
        return $empresa;
    }

    private function autorizarVaga(Vaga $vaga, EmpresaConcedente $empresa): void
    {
        abort_if($vaga->empresa_id !== $empresa->id, 403, 'Acesso nao autorizado a esta vaga.');
    }

    private function validarVaga(Request $request): array
    {
        return $request->validate([
            'nome_empresa'             => ['required', 'string', 'max:255'],
            'cnpj_empresa'             => ['required', 'string', 'max:32'],
            'ramo_empresa'             => ['nullable', 'string', 'max:255'],
            'descricao_empresa'        => ['nullable', 'string'],
            'endereco_empresa'         => ['nullable', 'string', 'max:255'],
            'contato_empresa'          => ['nullable', 'string', 'max:255'],
            'email_empresa'            => ['nullable', 'email', 'max:255'],
            'telefone_empresa'         => ['nullable', 'string', 'max:50'],
            'titulo'                   => ['required', 'string', 'max:255'],
            'area_atuacao'             => ['required', 'string', 'max:255'],
            'quantidade'               => ['required', 'integer', 'min:1', 'max:999'],
            'modalidade'               => ['required', Rule::in(['Presencial', 'Hibrido', 'Remoto'])],
            'cidade_estado'            => ['nullable', 'string', 'max:255'],
            'inicio_previsto'          => ['nullable', 'string', 'max:255'],
            'formacao_aceita'          => ['nullable', 'string'],
            'cursos'                   => ['nullable', 'string'],
            'periodo_minimo'           => ['nullable', 'string', 'max:255'],
            'conhecimentos_desejaveis' => ['nullable', 'string'],
            'competencias'             => ['nullable', 'string'],
            'atividades'               => ['nullable', 'string'],
            'horas_dia'                => ['nullable', 'string', 'max:50'],
            'dias'                     => ['nullable', 'string', 'max:255'],
            'horario'                  => ['nullable', 'string', 'max:255'],
            'flexibilidade'            => ['nullable', 'string', 'max:255'],
            'bolsa_auxilio'            => ['nullable', 'numeric', 'min:0'],
            'transporte'               => ['nullable', 'string', 'max:255'],
            'alimentacao'              => ['nullable', 'string', 'max:255'],
            'seguro'                   => ['nullable', 'string', 'max:255'],
            'outros_beneficios'        => ['nullable', 'string'],
            'contratacao_tipo'         => ['required', Rule::in(['Obrigatorio', 'Nao obrigatorio'])],
            'duracao'                  => ['nullable', 'string', 'max:255'],
            'possibilidade_efetivacao' => ['nullable', 'string', 'max:255'],
            'etapas'                   => ['nullable', 'string'],
            'prazo'                    => ['nullable', 'date'],
            'retorno'                  => ['nullable', 'string'],
            'link_candidatura'         => ['nullable', 'string', 'max:255'],
            'email_candidatura'        => ['nullable', 'email', 'max:255'],
            'instrucoes_candidatura'   => ['nullable', 'string'],
            'observacoes'              => ['nullable', 'string'],
            'ativa'                    => ['nullable', 'boolean'],
        ]);
    }

    private function normalizarDadosVaga(array $validated): array
    {
        $validated['ativa'] = (bool) ($validated['ativa'] ?? true);
        return $validated;
    }
}
