<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;

Route::get('/', function () {
    return view('index');
});

Route::get('/cadastro/sala', [SalaController::class, 'create'])->name('salas.create');

Route::post('/cadastro/sala', [SalaController::class, 'store'])->name('salas.store');

Route::get('/listagem/salas', [SalaController::class, 'index'])->name('salas.index');

Route::get('/sala/{id}', [SalaController::class, 'edit'])->name('salas.edit');

Route::put('/sala/{id}', [SalaController::class, 'update'])->name('salas.update');

Route::delete('/sala/delete/{id}', [SalaController::class, 'destroy'])->name('salas.destroy');

Route::resource('cursos', CursoController::class);

Route::resource('turmas', TurmaController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
