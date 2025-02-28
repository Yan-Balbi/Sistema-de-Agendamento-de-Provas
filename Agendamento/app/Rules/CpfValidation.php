<?php


namespace App\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


class CpfValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $value = preg_replace('/\D/', '', $value);


        // Verifica se é CPF ou CNPJ
        if (!$this->validateCpf($value)) {
            $fail('O CPF informado é inválido.');
        }

    }


    private function validateCpf($cpf): bool
    {
        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }


        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }


        return true;
    }
}
