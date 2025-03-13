<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/agendamento/listar', [AgendamentoController::class, 'index'])
        ->name('agendamentos.index');

// Grupo de rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {

    // Criar agendamento (somente quem tem permissão 'agendamento-create')
    Route::get('/agendamento/cadastro', [AgendamentoController::class, 'create'])
        ->name('agendamentos.create')
        ->middleware('can:agendamento-create');

    // Salvar novo agendamento (somente quem tem permissão 'agendamento-create')
    Route::post('/agendamento/cadastro', [AgendamentoController::class, 'store'])
        ->name('agendamentos.store')
        ->middleware('can:agendamento-create');

    // Listar agendamentos (somente quem tem permissão 'agendamento-list')

    // Editar agendamento (somente quem tem permissão 'agendamento-update')
    Route::get('/agendamento/edit/{id}', [AgendamentoController::class, 'edit'])
        ->name('agendamentos.edit')
        ->middleware('can:agendamento-update');

    // Atualizar agendamento (somente quem tem permissão 'agendamento-update')
    Route::put('/agendamento/{id}', [AgendamentoController::class, 'update'])
        ->name('agendamentos.update')
        ->middleware('can:agendamento-update');

    // Apagar agendamento (somente quem tem permissão 'agendamento-delete')
    Route::delete('/agendamento/delete/{id}', [AgendamentoController::class, 'destroy'])
        ->name('agendamento.destroy')
        ->middleware('can:agendamento-delete');

    // Buscar cursos para agendamento (somente quem tem permissão 'curso-list')
    Route::get('/agendamento/index-cursos', [AgendamentoController::class, 'buscarTodosOsCursos'])
        ->name('agendamentos.index-cursos')
        ->middleware('can:curso-list');

    // Buscar turmas para um curso (somente quem tem permissão 'turma-list')
    Route::get('/agendamento/index-turmas', [AgendamentoController::class, 'buscarTurmasDeUmCurso'])
        ->name('agendamentos.index-turmas')
        ->middleware('can:turma-list');

    // Buscar professores de uma turma (somente quem tem permissão 'professor-list')
    Route::get('/agendamento/index-professores', [AgendamentoController::class, 'buscarTodosOsProfessoresDeUmaTurma'])
        ->name('agendamentos.index-professores')
        ->middleware('can:professor-list');

    // Buscar disciplinas (somente quem tem permissão 'disciplina-list')
    Route::get('/agendamento/index-disciplinas', [AgendamentoController::class, 'buscarDisciplinasDeUmaTurmaDeUmCursoEDeUmProfessor'])
        ->name('agendamentos.index-disciplinas')
        ->middleware('can:disciplina-list');

    // Buscar salas disponíveis (somente quem tem permissão 'sala-list')
    Route::get('/agendamento/index-salas', [AgendamentoController::class, 'buscarSalas'])
        ->name('agendamentos.index-salas')
        ->middleware('can:sala-list');

    // Buscar horários disponíveis (somente quem tem permissão 'intervalo-hora-agendamento-list')
    Route::get('/agendamento/index-horarios', [AgendamentoController::class, 'buscarHorarios'])
        ->name('agendamentos.index-horarios')
        ->middleware('can:intervalo-hora-agendamento-list');
});
