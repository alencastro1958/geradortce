<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas explícitas para Instituições (corrigindo parâmetro)
    Route::get('/instituicoes', [App\Http\Controllers\InstituicaoEnsinoController::class, 'index'])->name('instituicoes.index');
    Route::post('/instituicoes', [App\Http\Controllers\InstituicaoEnsinoController::class, 'store'])->name('instituicoes.store');
    Route::get('/instituicoes/criar', [App\Http\Controllers\InstituicaoEnsinoController::class, 'create'])->name('instituicoes.create');
    Route::get('/instituicoes/{id}/editar', [App\Http\Controllers\InstituicaoEnsinoController::class, 'edit'])->name('instituicoes.edit');
    Route::put('/instituicoes/{id}', [App\Http\Controllers\InstituicaoEnsinoController::class, 'update'])->name('instituicoes.update');
    Route::delete('/instituicoes/{id}', [App\Http\Controllers\InstituicaoEnsinoController::class, 'destroy'])->name('instituicoes.destroy');
    
    Route::resource('empresas', \App\Http\Controllers\EmpresaConcedenteController::class);
    Route::resource('estagiarios', \App\Http\Controllers\EstagiarioController::class);
    Route::get('seguradoras/{seguradora}/download', [\App\Http\Controllers\SeguradoraController::class, 'download'])->name('seguradoras.download');
    Route::resource('seguradoras', \App\Http\Controllers\SeguradoraController::class);
    Route::get('agente-integracao', [\App\Http\Controllers\AgenteIntegracaoController::class, 'index'])->name('agente.index');
    Route::put('agente-integracao', [\App\Http\Controllers\AgenteIntegracaoController::class, 'update'])->name('agente.update');

    Route::resource('estagios', \App\Http\Controllers\EstagioController::class);
    Route::get('estagios/{estagio}/gerar-documento', [\App\Http\Controllers\EstagioController::class, 'gerarDocumento'])->name('estagios.gerar-documento');
    Route::get('estagios/{estagio}/baixar-documento', [\App\Http\Controllers\EstagioController::class, 'baixarDocumento'])->name('estagios.baixar-documento');

    // API de Consulta CNPJ
    Route::get('/api/consultar-cnpj', [\App\Http\Controllers\CnpjController::class, 'consultar'])->name('api.consultar-cnpj');

    // Supervisores de Estágio (nested under empresas)
    Route::get('empresas/{empresa}/supervisores/criar', [\App\Http\Controllers\SupervisorEstagioController::class, 'create'])->name('supervisores.create');
    Route::post('empresas/{empresa}/supervisores', [\App\Http\Controllers\SupervisorEstagioController::class, 'store'])->name('supervisores.store');
    Route::get('empresas/{empresa}/supervisores/{supervisor}/editar', [\App\Http\Controllers\SupervisorEstagioController::class, 'edit'])->name('supervisores.edit');
    Route::put('empresas/{empresa}/supervisores/{supervisor}', [\App\Http\Controllers\SupervisorEstagioController::class, 'update'])->name('supervisores.update');
    Route::delete('empresas/{empresa}/supervisores/{supervisor}', [\App\Http\Controllers\SupervisorEstagioController::class, 'destroy'])->name('supervisores.destroy');

    // Representantes Legais
    Route::get('representantes/{tipo}/{entidadeId}/criar', [\App\Http\Controllers\RepresentanteLegalController::class, 'create'])->name('representantes.create');
    Route::post('representantes/{tipo}/{entidadeId}', [\App\Http\Controllers\RepresentanteLegalController::class, 'store'])->name('representantes.store');
    Route::get('representantes/{representante}/editar', [\App\Http\Controllers\RepresentanteLegalController::class, 'edit'])->name('representantes.edit');
    Route::put('representantes/{representante}', [\App\Http\Controllers\RepresentanteLegalController::class, 'update'])->name('representantes.update');
    Route::delete('representantes/{representante}', [\App\Http\Controllers\RepresentanteLegalController::class, 'destroy'])->name('representantes.destroy');

    // API - Supervisores por Empresa
    Route::get('/api/empresas/{empresa}/supervisores', [\App\Http\Controllers\ApiSupervisorController::class, 'byEmpresa'])->name('api.supervisores');

    // Sistema de Vagas (admin)
    Route::post('/vagas/{vaga}/candidatar', [\App\Http\Controllers\VagaController::class, 'candidatar'])->name('vagas.candidatar');
    Route::resource('vagas', \App\Http\Controllers\VagaController::class)->except(['show']);
});

// Portal público de acesso — hub para candidatos, empresas, IEs e vagas
Route::get('/candidate-se', fn() => view('portal.candidato'))->name('candidato.portal');

// Vagas públicas — sem autenticação, acessível a estudantes externos
Route::get('/vagas/oportunidades', [\App\Http\Controllers\VagaController::class, 'buscaPublica'])->name('vagas.busca');

require __DIR__.'/auth.php';

// Redireciona /empresas/login (plural) para o portal correto
Route::get('/empresas/login', fn() => redirect()->route('empresa.login'));

// ─── Portal do Supervisor ─────────────────────────────────────────────────────
use App\Http\Controllers\EmpresaPortalController;
use App\Http\Controllers\SupervisorPortalController;

Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('login', [SupervisorPortalController::class, 'loginForm'])->name('login');
    Route::post('login', [SupervisorPortalController::class, 'login'])->name('login.submit');

    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [SupervisorPortalController::class, 'logout'])->name('logout');
        Route::get('dashboard', [SupervisorPortalController::class, 'dashboard'])->name('dashboard');

        Route::get('estagios/{estagio}/relatorios/criar', [SupervisorPortalController::class, 'criarRelatorio'])->name('relatorio.criar');
        Route::post('estagios/{estagio}/relatorios', [SupervisorPortalController::class, 'salvarRelatorio'])->name('relatorio.salvar');
        Route::get('relatorios/{relatorio}/editar', [SupervisorPortalController::class, 'editarRelatorio'])->name('relatorio.editar');
        Route::put('relatorios/{relatorio}', [SupervisorPortalController::class, 'atualizarRelatorio'])->name('relatorio.atualizar');
        Route::get('relatorios/{relatorio}/pdf', [SupervisorPortalController::class, 'gerarPdf'])->name('relatorio.pdf');
    });
});

Route::prefix('empresa')->name('empresa.')->group(function () {
    Route::get('login', [EmpresaPortalController::class, 'loginForm'])->name('login');
    Route::post('login', [EmpresaPortalController::class, 'login'])->name('login.submit');
    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [EmpresaPortalController::class, 'logout'])->name('logout');
    });
});

// Admin: criar/revogar acesso supervisor
Route::middleware('auth')->group(function () {
    Route::post('supervisores/{supervisor}/criar-acesso', [SupervisorPortalController::class, 'criarAcesso'])->name('supervisor.criar-acesso');
    Route::delete('supervisores/{supervisor}/revogar-acesso', [SupervisorPortalController::class, 'revogarAcesso'])->name('supervisor.revogar-acesso');
    Route::post('empresas/{empresa}/criar-acesso', [EmpresaPortalController::class, 'criarAcesso'])->name('empresa.criar-acesso');
    Route::delete('empresas/{empresa}/revogar-acesso', [EmpresaPortalController::class, 'revogarAcesso'])->name('empresa.revogar-acesso');
    Route::post('empresas/{empresa}/alterar-senha', [EmpresaPortalController::class, 'alterarSenha'])->name('empresa.alterar-senha');
    Route::post('empresas/{empresa}/alterar-slug', [EmpresaPortalController::class, 'alterarSlug'])->name('empresa.alterar-slug');
});

// ─── Portal da Empresa por slug: /{slug}/dashboard ────────────────────────────
// DEVE ficar por último para não conflitar com rotas específicas acima
Route::prefix('{slug}')->middleware('auth')
    ->where(['slug' => '[a-zA-Z][a-zA-Z0-9\-]*'])
    ->group(function () {
        Route::get('dashboard', [EmpresaPortalController::class, 'dashboard'])->name('empresa.dashboard');
        Route::get('vagas', fn(string $slug) => redirect()->route('empresa.vagas.create', ['slug' => $slug]))->name('empresa.vagas.index');
        Route::get('vagas/criar', [EmpresaPortalController::class, 'createVaga'])->name('empresa.vagas.create');
        Route::post('vagas', [EmpresaPortalController::class, 'storeVaga'])->name('empresa.vagas.store');
        Route::get('vagas/{vaga}/editar', [EmpresaPortalController::class, 'editVaga'])->name('empresa.vagas.edit');
        Route::put('vagas/{vaga}', [EmpresaPortalController::class, 'updateVaga'])->name('empresa.vagas.update');
        Route::delete('vagas/{vaga}', [EmpresaPortalController::class, 'destroyVaga'])->name('empresa.vagas.destroy');
    });
