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
        // Entidades para gerar permissões automaticamente
        $entities = [
            'professor',
            'disciplina',
            'curso',
            'turma',
            'sala',
            'intervalo-data-agendamento',
            'intervalo-hora-agendamento',
            'agendamento' // Adicionando Agendamentos
        ];

        // Ações padrão para cada entidade
        $actions = ['create', 'read', 'update', 'delete', 'list'];

        $permissions = [];

        // Gerar permissões dinamicamente para cada entidade e ação
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permissions[] = "{$entity}-{$action}";
            }
        }

        // Permissões pré-existentes
        $defaultPermissions = [
            // Usuários
            'user-create', 'user-read', 'user-update', 'user-delete', 'user-list',

            // Papéis
            'role-create', 'role-read', 'role-update', 'role-delete', 'role-list',

            // Gerenciamento de permissões e papéis
            'assign-role-user', 'assign-permission-role',
        ];

        // Unindo todas as permissões
        $permissions = array_merge($permissions, $defaultPermissions);

        // Criar todas as permissões (evita duplicação)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Criando papéis e atribuindo permissões específicas
        $roles = [
            'Usuário registrado' => [],

            'Professor' => [
                'professor-list', 'professor-read',
                'disciplina-list', 'disciplina-read',
                'curso-list', 'curso-read',
                'turma-list', 'turma-read',
                'sala-list', 'sala-read',
                'intervalo-data-agendamento-list', 'intervalo-data-agendamento-read',
                'intervalo-hora-agendamento-list', 'intervalo-hora-agendamento-read',
                'agendamento-list', 'agendamento-read' // Professores podem visualizar agendamentos
            ],
        ];

        // Criar papéis e vincular permissões
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Garantir que o papel 'Diretor de Ensino' sempre tenha todas as permissões
        $adminRole = Role::firstOrCreate(['name' => 'Diretor de Ensino']);
        $adminRole->syncPermissions(Permission::pluck('name')->toArray());

        // Mensagem no terminal
        $this->command->info('Permissions and roles seeded successfully.');
    }
}
