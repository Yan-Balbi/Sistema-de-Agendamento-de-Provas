<?php

use App\Http\Controllers\ProfessorController;
use Illuminate\Support\Facades\Route;

Route::get('/professor/cadastro', [ProfessorController::class, 'create'])->name('professor.create');

Route::get('/professor/listar', [ProfessorController::class, 'listar'])->name('professor.listar');

Route::post('/professor/cadastro', [ProfessorController::class, 'store'])->name('professor.store');

Route::delete('/professor/delete/{id}', [ProfessorController::class, 'destroy'])->name('professor.destroy');

Route::get('/professor/{id}', [ProfessorController::class, 'edit'])->name('professor.edit');

Route::put('/professor/{id}', [ProfessorController::class, 'update'])->name('professor.update');
