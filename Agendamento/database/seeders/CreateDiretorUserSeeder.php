<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateDiretorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Diretor de Ensino',
            'cpf' => '45796354000',
            'email' => 'diretor@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->markEmailAsVerified();
        // Buscar a role 'admin'
        $role = Role::where('name', 'Diretor de Ensino')->first();

        if ($role) {
            // Atribuir todas as permissões à role
            $permissions = Permission::pluck('id')->all();
            $role->syncPermissions($permissions);

            // Atribuir a role ao usuário
            $user->assignRole('Diretor de Ensino');
        } else {
            // Opcional: lançar uma exceção ou exibir um aviso
            $this->command->warn('Role "Diretor de Ensino" não encontrada. Execute a seed das roles primeiro.');
        }
    }
}
