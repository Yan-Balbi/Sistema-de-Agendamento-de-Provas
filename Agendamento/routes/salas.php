<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;

Route::get('/sala/cadastro', [SalaController::class, 'create'])->name('salas.create');

Route::post('/sala/cadastro', [SalaController::class, 'store'])->name('salas.store');

Route::get('/sala/listar', [SalaController::class, 'index'])->name('salas.index');

Route::get('/sala/{id}', [SalaController::class, 'edit'])->name('salas.edit');

Route::put('/sala/{id}', [SalaController::class, 'update'])->name('salas.update');

Route::delete('/sala/delete/{id}', [SalaController::class, 'destroy'])->name('salas.destroy');
