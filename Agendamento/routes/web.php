<?php

use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::prefix('/')->group(base_path('routes/professores.php'));
Route::prefix('/')->group(base_path('routes/salas.php'));

Route::prefix('/roles')->group(base_path('routes/roles.php'));
Route::prefix('/users')->group(base_path('routes/users.php'));

Route::resource('cursos', CursoController::class);

Route::resource('turmas', TurmaController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
