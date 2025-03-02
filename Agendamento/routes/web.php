<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('header');
});

Route::get('/cadastro/sala', [SalaController::class, 'create'])->name('salas.create');

Route::post('/cadastro/sala', [SalaController::class, 'store'])->name('salas.store');

Route::get('/listagem/salas', [SalaController::class, 'index'])->name('salas.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
