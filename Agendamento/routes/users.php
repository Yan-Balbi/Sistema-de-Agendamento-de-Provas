<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// 🔹 Grupo de Rotas Protegidas com Middleware de Autenticação
Route::middleware(['auth'])->group(function () {

    // 🔹 Listar usuários (user-list)
    Route::get('', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:user-list');

    // 🔹 Criar um novo usuário (user-create)
    Route::get('/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:user-create');

    // 🔹 Armazenar um novo usuário (user-create)
    Route::post('', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('permission:user-create');

    // 🔹 Exibir um usuário específico (user-read)
    Route::get('/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:user-read');

    // 🔹 Editar um usuário (user-update)
    Route::get('/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:user-update');

    // 🔹 Atualizar um usuário (user-update)
    Route::put('/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:user-update');

    // 🔹 Excluir um usuário (user-delete)
    Route::delete('/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:user-delete');

    // 🔹 Atribuir papéis a usuários (assign-role-user)
    Route::post('/{user}/roles', [UserController::class, 'assignRoleToUser'])
        ->name('users.roles.assign')
        ->middleware('permission:assign-role-user');
});
