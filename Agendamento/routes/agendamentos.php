<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/agendamento/cadastro', [AgendamentoController::class, 'create'])->name('agendamentos.create');

Route::post('/agendamento/cadastro', [AgendamentoController::class, 'store'])->name('agendamentos.store');

Route::get('/agendamento/listar', [AgendamentoController::class, 'index'])->name('agendamentos.index');

Route::get('/agendamento/edit/{id}', [AgendamentoController::class, 'edit'])->name('agendamentos.edit');


Route::put('/agendamento/{id}', [AgendamentoController::class, 'update'])->name('agendamentos.update');

Route::delete('/agendamento/delete/{id}', [AgendamentoController::class, 'destroy'])->name('agendamento.destroy');

Route::get('/agendamento/index-cursos', [AgendamentoController::class, 'buscarTodosOsCursos'])->name('agendamentos.index-cursos');

Route::get('/agendamento/index-turmas', [AgendamentoController::class, 'buscarTurmasDeUmCurso'])->name('agendamentos.index-turmas');

Route::get('/agendamento/index-professores', [AgendamentoController::class, 'buscarTodosOsProfessoresDeUmaTurma'])->name('agendamentos.index-professores');

Route::get('/agendamento/index-disciplinas', [AgendamentoController::class, 'buscarDisciplinasDeUmaTurmaDeUmCursoEDeUmProfessor'])->name('agendamentos.index-disciplinas');

Route::get('/agendamento/index-salas', [AgendamentoController::class, 'buscarSalas'])->name('agendamentos.index-salas');

Route::get('/agendamento/index-horarios', [AgendamentoController::class, 'buscarHorarios'])->name('agendamentos.index-horarios');


