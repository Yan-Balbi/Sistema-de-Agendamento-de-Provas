<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HorariosController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HorariosController::class, 'index'])->name('home');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
//     Route::resource('cursos', CursoController::class);
//     Route::prefix('/')->group(base_path('routes/salas.php'));
//     Route::resource('turmas', TurmaController::class);
//     Route::resource('cursos', CursoController::class);
//     Route::prefix('/users')->group(base_path('routes/users.php'));
//     Route::prefix('/roles')->group(base_path('routes/roles.php'));
//     Route::prefix('/')->group(base_path('routes/agendamentos.php'));
//     Route::prefix('/')->group(base_path('routes/salas.php'));
//     Route::prefix('/')->group(base_path('routes/professores.php'));
//     Route::prefix('/')->group(base_path('routes/disciplinas.php'));
//     Route::prefix('/')->group(base_path('routes/horaAgendamento.php'));
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('cursos', CursoController::class);
Route::prefix('/')->group(base_path('routes/salas.php'));
Route::resource('turmas', TurmaController::class);
Route::resource('cursos', CursoController::class);
Route::prefix('/users')->group(base_path('routes/users.php'));
Route::prefix('/roles')->group(base_path('routes/roles.php'));
Route::prefix('/')->group(base_path('routes/agendamentos.php'));
Route::prefix('/')->group(base_path('routes/salas.php'));
Route::prefix('/')->group(base_path('routes/professores.php'));
Route::prefix('/')->group(base_path('routes/disciplinas.php'));
Route::prefix('/')->group(base_path('routes/horaAgendamento.php'));
