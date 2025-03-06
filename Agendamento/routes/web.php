<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\ProfessorController;

Route::get('/', function () {
    return view('index');
});


Route::get('/professor/cadastro', [ProfessorController::class, 'create'])->name('professor.create');

Route::get('/professor/listar', [ProfessorController::class, 'listar'])->name('professor.listar');

Route::post('/professor/cadastro', [ProfessorController::class, 'store'])->name('professor.store');

Route::delete('/professor/delete/{id}', [ProfessorController::class, 'destroy'])->name('professor.destroy');

Route::get('/professor/{id}', [ProfessorController::class, 'edit'])->name('professor.edit');

Route::put('/professor/{id}', [ProfessorController::class, 'update'])->name('professor.update');

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
