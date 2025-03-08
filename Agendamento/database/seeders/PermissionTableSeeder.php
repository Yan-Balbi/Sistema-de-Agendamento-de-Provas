<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de permissões organizadas
        $permissions = [
            // Usuários
            'user-create', 'user-read', 'user-update', 'user-delete', 'user-list',

            // Papéis
            'role-create', 'role-read', 'role-update', 'role-delete', 'role-list',

            // Gerenciamento de permissões e papéis
            'assign-role-user', 'assign-permission-role',
        ];

        // Criar todas as permissões (evita duplicação)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Criando papéis com permissões específicas
        $roles = [
            'Usuário registrado' => [''],
            'Professor' => [''],
            'Estudante' => [''],
        ];

        // Criar papéis e vincular permissões
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Garantir que o papel 'admin' sempre tenha todas as permissões
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::pluck('name')->toArray()); // Sempre pega todas as permissões

        // Mensagem no terminal
        $this->command->info('Permissions and roles seeded successfully.');
    }
}
