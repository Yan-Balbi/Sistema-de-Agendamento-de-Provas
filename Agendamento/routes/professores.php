<?php

use App\Http\Controllers\ProfessorController;
use Illuminate\Support\Facades\Route;

// Grupo de rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Criar professor (somente quem tem permissão 'professor-create')
    Route::get('/professor/cadastro', [ProfessorController::class, 'create'])
        ->name('professor.create')
        ->middleware('can:professor-create');

    // Listar professores (somente quem tem permissão 'professor-list')
    Route::get('/professor/listar', [ProfessorController::class, 'listar'])
        ->name('professor.listar')
        ->middleware('can:professor-list');

    // Salvar novo professor (somente quem tem permissão 'professor-create')
    Route::post('/professor/cadastro', [ProfessorController::class, 'store'])
        ->name('professor.store')
        ->middleware('can:professor-create');

    // Apagar professor (somente quem tem permissão 'professor-delete')
    Route::delete('/professor/delete/{id}', [ProfessorController::class, 'destroy'])
        ->name('professor.destroy')
        ->middleware('can:professor-delete');

    // Editar professor (somente quem tem permissão 'professor-update')
    Route::get('/professor/{id}', [ProfessorController::class, 'edit'])
        ->name('professor.edit')
        ->middleware('can:professor-update');

    // Atualizar professor (somente quem tem permissão 'professor-update')
    Route::put('/professor/{id}', [ProfessorController::class, 'update'])
        ->name('professor.update')
        ->middleware('can:professor-update');
});
