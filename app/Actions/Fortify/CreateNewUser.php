<?php

namespace App\Actions\Fortify;

use App\Models\PreCadastro;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
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
                Rule::unique(User::class, 'email'),
                Rule::exists('pre_registros', 'email_institucional')->where('status', 'pendente'),
            ],
            'password' => $this->passwordRules(),
        ], [
            'email.exists' => 'E-mail institucional não encontrado ou já ativado.',
            'email.unique' => 'Este e-mail institucional já possui uma conta ativa.',
        ])->validate();

        return DB::transaction(function () use ($input): User {
            $preCadastro = PreCadastro::where('email_institucional', $input['email'])
                ->where('status', 'pendente')
                ->lockForUpdate()
                ->firstOrFail();

            $user = User::create([
                'name' => $input['name'],
                'email' => $preCadastro->email_institucional,
                'password' => Hash::make($input['password']),
                'role_id' => $preCadastro->role_id,
                'escola_id' => $preCadastro->escola_id,
                'pre_registro_id' => $preCadastro->id,
                'status_ativacao' => 'ativo',
            ]);

            $preCadastro->update(['status' => 'ativado']);

            return $user;
        });
    }
}