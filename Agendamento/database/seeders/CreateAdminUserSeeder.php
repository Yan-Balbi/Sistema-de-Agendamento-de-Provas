<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'cpf' => '45796354000',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->markEmailAsVerified();
        // Buscar a role 'admin'
        $role = Role::where('name', 'Admin')->first();

        if ($role) {
            // Atribuir todas as permissões à role
            $permissions = Permission::pluck('id')->all();
            $role->syncPermissions($permissions);

            // Atribuir a role ao usuário
            $user->assignRole('Admin');
        } else {
            // Opcional: lançar uma exceção ou exibir um aviso
            $this->command->warn('Role "admin" não encontrada. Execute a seed das roles primeiro.');
        }
    }
}
