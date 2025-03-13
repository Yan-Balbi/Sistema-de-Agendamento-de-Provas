<?php

use App\Http\Controllers\HoraAgendamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/hora-agendamento', [HoraAgendamentoController::class, 'index'])->name('hora-agendamento.index');
Route::get('/hora-agendamento/create', [HoraAgendamentoController::class, 'create'])->name('hora-agendamento.create');
Route::post('/hora-agendamento', [HoraAgendamentoController::class, 'store'])->name('hora-agendamento.store');
Route::get('/hora-agendamento/{id}/edit', [HoraAgendamentoController::class, 'edit'])->name('hora-agendamento.edit');
Route::put('/hora-agendamento/{id}', [HoraAgendamentoController::class, 'update'])->name('hora-agendamento.update');
Route::delete('/hora-agendamento/{id}', [HoraAgendamentoController::class, 'destroy'])->name('hora-agendamento.destroy');
