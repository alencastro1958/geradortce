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

    // API de Consulta CNPJ
    Route::get('/api/consultar-cnpj', [\App\Http\Controllers\CnpjController::class, 'consultar'])->name('api.consultar-cnpj');

    // Sistema de Vagas
    Route::get('/vagas/oportunidades', [\App\Http\Controllers\VagaController::class, 'buscaPublica'])->name('vagas.busca');
    Route::post('/vagas/{vaga}/candidatar', [\App\Http\Controllers\VagaController::class, 'candidatar'])->name('vagas.candidatar');
    Route::resource('vagas', \App\Http\Controllers\VagaController::class)->except(['show']);
});

require __DIR__.'/auth.php';
