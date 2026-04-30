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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('instituicoes', \App\Http\Controllers\InstituicaoEnsinoController::class);
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
