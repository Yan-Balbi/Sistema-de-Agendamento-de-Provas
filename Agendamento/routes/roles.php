<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    // 🔹 Listar todos os papéis (role-list)
    Route::get('', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('permission:role-list');

    // 🔹 Criar um novo papel (role-create)
    Route::get('/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('permission:role-create');

    // 🔹 Armazenar um novo papel (role-create)
    Route::post('', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:role-create');

    // 🔹 Exibir um papel específico (role-read)
    Route::get('/{role}', [RoleController::class, 'show'])
        ->name('roles.show')
        ->middleware('permission:role-read');

    // 🔹 Editar um papel (role-update)
    Route::get('/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:role-update');

    // 🔹 Atualizar um papel (role-update)
    Route::put('/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('permission:role-update');

    // 🔹 Excluir um papel (role-delete)
    Route::delete('/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('permission:role-delete');

    // 🔹 Atribuir papéis a usuários (assign-role-user)
    Route::post('/{role}/assign', [RoleController::class, 'assignRoleToUser'])
        ->name('roles.assign')
        ->middleware('permission:assign-role-user');

    // 🔹 Atribuir permissões a papéis (assign-permission-role)
    Route::post('/{role}/permissions', [RoleController::class, 'assignPermissionToRole'])
        ->name('roles.permissions.assign')
        ->middleware('permission:assign-permission-role');
});
