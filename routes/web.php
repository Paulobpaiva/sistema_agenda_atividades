<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CalendarioAtividadesController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'usuario.ativo'])->group(function () {
    Route::get('/', [CalendarioAtividadesController::class, 'index'])
        ->name('calendario.index');

    Route::post('/atividades', [CalendarioAtividadesController::class, 'store'])
        ->name('atividades.store');

    Route::delete('/atividades/{atividade}', [CalendarioAtividadesController::class, 'destroy'])
        ->name('atividades.destroy');
});

Route::middleware(['auth', 'usuario.ativo', 'admin'])
    ->prefix('seguranca')
    ->name('seguranca.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('seguranca.usuarios.index');
        })->name('index');

        Route::get('/usuarios', [UsuarioController::class, 'index'])
            ->name('usuarios.index');

        Route::get('/usuarios/novo', [UsuarioController::class, 'create'])
            ->name('usuarios.create');

        Route::post('/usuarios', [UsuarioController::class, 'store'])
            ->name('usuarios.store');

        Route::get('/usuarios/{user}/editar', [UsuarioController::class, 'edit'])
            ->name('usuarios.edit');

        Route::put('/usuarios/{user}', [UsuarioController::class, 'update'])
            ->name('usuarios.update');

        Route::patch('/usuarios/{user}/senha', [UsuarioController::class, 'updatePassword'])
            ->name('usuarios.password');

        Route::patch('/usuarios/{user}/status', [UsuarioController::class, 'toggleStatus'])
            ->name('usuarios.status');

        Route::delete('/usuarios/{user}', [UsuarioController::class, 'destroy'])
            ->name('usuarios.destroy');
    });