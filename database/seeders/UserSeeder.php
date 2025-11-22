<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Busca os IDs das roles
        $adminRoleId = DB::table('roles')->where('acesso', 'admin')->value('id');
        $secretariaRoleId = DB::table('roles')->where('acesso', 'secretaria')->value('id');
        $direcaoRoleId = DB::table('roles')->where('acesso', 'direcao')->value('id');
        $coordenadorRoleId = DB::table('roles')->where('acesso', 'coordenador')->value('id');
        $professorRoleId = DB::table('roles')->where('acesso', 'professor')->value('id');

        $users = [
            // Administrador
            [
                'name' => 'Administrador Sistema',
                'email' => 'admin@avaliaedu.com',
                'password' => Hash::make('Admin123#!'),
                'escola_id' => null,
                'role_id' => $adminRoleId,
                'status_ativacao' => 'ativo',
            ],
            // Secretaria
            [
                'name' => 'Teste - Secretaria',
                'email' => 'teste@secretaria.gov.br',
                'password' => Hash::make('Secretaria123#!'),
                'escola_id' => 1,
                'role_id' => $secretariaRoleId,
                'status_ativacao' => 'ativo',
            ],
            // Direção
            [
                'name' => 'Diretor', 
                'email' => 'teste@direcao.gov.br',
                'password' => Hash::make('Direcao123#!'),
                'escola_id' => 1,
                'role_id' => $direcaoRoleId,
                'status_ativacao' => 'ativo',
            ],
            // Coordenação
            [
                'name' => 'Coordenadora',
                'email' => 'teste@coordenador.gov.br',
                'password' => Hash::make('Coordenacao123#!'),
                'escola_id' => 1,
                'role_id' => $coordenadorRoleId,
                'status_ativacao' => 'ativo',
            ],
            // Professor
            [
                'name' => 'Professor',
                'email' => 'teste@professor.gov.br',
                'password' => Hash::make('Professor123#!'),
                'escola_id' => 1,
                'role_id' => $professorRoleId,
                'status_ativacao' => 'ativo',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}