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
    Route::resource('estagios', \App\Http\Controllers\EstagioController::class);
});

require __DIR__.'/auth.php';
