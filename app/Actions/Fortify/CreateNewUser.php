<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\PreRegistro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;
use Laravel\Fortify\Rules\PasswordValidationRules;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
    'name' => ['required', 'string', 'max:255'], 
    'email' => [
        'required',
        'string', 
        'email',
        'max:255',
        Rule::exists('pre_registro', 'email_institucional')->where('status', 'pendente')
    ],
    'password' => $this->passwordRules(),
], [
    'email.exists' => 'Email institucional não encontrado ou já ativado.'
])->validate();

// Cria o usuário
$user = User::create([
    'name' => $input['name'], 
    'email' => $preRegistro->email_institucional,
    'password' => Hash::make($input['password']),
    'role_id' => $preRegistro->role_id,
    'escola_id' => $preRegistro->escola_id,
    'status_ativacao' => 'ativo',
]);

        // Atualiza o pré-registro
        $preRegistro->update(['status' => 'ativado']);

        return $user;
    }
}