<?php

use App\Http\Controllers\HoraAgendamentoController;
use Illuminate\Support\Facades\Route;

// Grupo de rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Listar horários de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-list')
    Route::get('/hora-agendamento', [HoraAgendamentoController::class, 'index'])
        ->name('hora-agendamento.index')
        ->middleware('can:intervalo-hora-agendamento-list');

    // Criar novo horário de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-create')
    Route::get('/hora-agendamento/create', [HoraAgendamentoController::class, 'create'])
        ->name('hora-agendamento.create')
        ->middleware('can:intervalo-hora-agendamento-create');

    // Salvar horário de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-create')
    Route::post('/hora-agendamento', [HoraAgendamentoController::class, 'store'])
        ->name('hora-agendamento.store')
        ->middleware('can:intervalo-hora-agendamento-create');

    // Editar horário de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-update')
    Route::get('/hora-agendamento/{id}/edit', [HoraAgendamentoController::class, 'edit'])
        ->name('hora-agendamento.edit')
        ->middleware('can:intervalo-hora-agendamento-update');

    // Atualizar horário de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-update')
    Route::put('/hora-agendamento/{id}', [HoraAgendamentoController::class, 'update'])
        ->name('hora-agendamento.update')
        ->middleware('can:intervalo-hora-agendamento-update');

    // Deletar horário de agendamento (somente quem tem permissão 'intervalo-hora-agendamento-delete')
    Route::delete('/hora-agendamento/{id}', [HoraAgendamentoController::class, 'destroy'])
        ->name('hora-agendamento.destroy')
        ->middleware('can:intervalo-hora-agendamento-delete');
});
