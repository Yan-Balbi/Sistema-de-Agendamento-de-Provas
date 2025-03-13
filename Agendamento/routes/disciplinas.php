<?php

use App\Http\Controllers\DisciplinaController;
use Illuminate\Support\Facades\Route;

Route::get('/disciplina/cadastro', [DisciplinaController::class, 'create'])->name('disciplina.create');

Route::get('/disciplina/listar', [DisciplinaController::class, 'listar'])->name('disciplina.listar');

Route::post('/disciplina/cadastro', [DisciplinaController::class, 'store'])->name('disciplina.store');

Route::delete('/disciplina/delete/{id}', [DisciplinaController::class, 'destroy'])->name('disciplina.destroy');

Route::get('/disciplina/{id}', [DisciplinaController::class, 'edit'])->name('disciplina.edit');

Route::put('/disciplina/{id}', [DisciplinaController::class, 'update'])->name('disciplina.update');
