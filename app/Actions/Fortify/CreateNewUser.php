<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\PreRegistro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;
use App\Models\PreRegistro;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
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

        // Busca o pré-registro
        $preRegistro = PreRegistro::where('email_institucional', $input['email'])
                                 ->where('status', 'pendente')
                                 ->firstOrFail();

        // Cria o usuário
        $user = User::create([
            'username' => $input['username'],
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