<?php

use App\Http\Controllers\Autenticacao\CadastroUsuarioController;
use App\Http\Controllers\Autenticacao\SessaoAutenticadaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [SessaoAutenticadaController::class, 'create'])->name('login');
    Route::post('/login', [SessaoAutenticadaController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('entrar.autenticar');

    Route::get('/register', [CadastroUsuarioController::class, 'create'])->name('cadastro');
    Route::post('/register', [CadastroUsuarioController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('cadastro.armazenar');
});

Route::middleware('auth')->group(function (): void {
    Route::view('/dashboard', 'painel')->name('painel');
    Route::post('/logout', [SessaoAutenticadaController::class, 'destroy'])->name('sair');
});
