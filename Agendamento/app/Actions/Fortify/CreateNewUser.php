<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\CpfValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $cpfCnpj = preg_replace('/\D/', '', $input['cpf']);

        // Valida se o CPF já existe no banco antes de tentar salvar
        if (User::where('cpf', $cpfCnpj)->exists()) {
            throw ValidationException::withMessages([
                'cpf' => 'Este CPF já está registrado.',
            ]);
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:18', 'unique:users', new CpfValidation()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return (User::create([
            'name' => $input['name'],
            'cpf' => preg_replace('/\D/', '', $input['cpf']),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]))->assignRole('Usuário Registrado');
    }
}
