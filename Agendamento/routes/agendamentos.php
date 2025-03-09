<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/agendamento/cadastro', [AgendamentoController::class, 'create'])->name('agendamentos.create');

// Route::post('/agendamento/cadastro', [AgendamentoController::class, 'store'])->name('agendamento.store');

Route::get('/agendament/listar', [AgendamentoController::class, 'index'])->name('agendamentos.index');

// Route::get('/agendamento/{id}', [AgendamentoController::class, 'edit'])->name('agendamento.edit');

// Route::put('/agendamento/{id}', [AgendamentoController::class, 'update'])->name('agendamento.update');

// Route::delete('/agendamento/delete/{id}', [AgendamentoController::class, 'destroy'])->name('agendamento.destroy');
