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

    // Sistema de Vagas
    Route::get('/vagas/oportunidades', [\App\Http\Controllers\VagaController::class, 'buscaPublica'])->name('vagas.busca');
    Route::post('/vagas/{vaga}/candidatar', [\App\Http\Controllers\VagaController::class, 'candidatar'])->name('vagas.candidatar');
    Route::resource('vagas', \App\Http\Controllers\VagaController::class)->except(['show']);
});

require __DIR__.'/auth.php';
