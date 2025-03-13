<?php

use App\Http\Controllers\DisciplinaController;
use Illuminate\Support\Facades\Route;

// Grupo de rotas protegidas por permissão
Route::middleware(['auth'])->group(function () {

    // Criar disciplina (somente quem tem permissão 'disciplina-create')
    Route::get('/disciplina/cadastro', [DisciplinaController::class, 'create'])
        ->name('disciplina.create')
        ->middleware('can:disciplina-create');

    // Listar disciplinas (somente quem tem permissão 'disciplina-list')
    Route::get('/disciplina/listar', [DisciplinaController::class, 'listar'])
        ->name('disciplina.listar')
        ->middleware('can:disciplina-list');

    // Salvar nova disciplina (somente quem tem permissão 'disciplina-create')
    Route::post('/disciplina/cadastro', [DisciplinaController::class, 'store'])
        ->name('disciplina.store')
        ->middleware('can:disciplina-create');

    // Apagar disciplina (somente quem tem permissão 'disciplina-delete')
    Route::delete('/disciplina/delete/{id}', [DisciplinaController::class, 'destroy'])
        ->name('disciplina.destroy')
        ->middleware('can:disciplina-delete');

    // Editar disciplina (somente quem tem permissão 'disciplina-update')
    Route::get('/disciplina/{id}', [DisciplinaController::class, 'edit'])
        ->name('disciplina.edit')
        ->middleware('can:disciplina-update');

    // Atualizar disciplina (somente quem tem permissão 'disciplina-update')
    Route::put('/disciplina/{id}', [DisciplinaController::class, 'update'])
        ->name('disciplina.update')
        ->middleware('can:disciplina-update');
});
