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
                'username'=>'admin',
                'email' => 'admin@avaliaedu.com',
                'password' => Hash::make('admin123#'),
                'escola_id' => null,
                'role_id' => $adminRoleId,
            ],
            // Secretaria
            [
                'name' => 'Teste - Secretaria',
                'username'=>'secretaria',
                'email' => 'teste@secretaria.gov.br',
                'password' => Hash::make('secretaria123#'),
                'escola_id' => 1, // ajuste conforme sua escola de teste
                'role_id' => $secretariaRoleId,
            ],
            // Direção
            [
                'name' => ' Diretor',
                'username'=>'direcao',
                'email' => 'teste@direcao.gov.br',
                'password' => Hash::make('direcao123#'),
                'escola_id' => 1,
                'role_id' => $direcaoRoleId,
            ],
            // Coordenação
            [
                'name' => 'Coordenadora',
                'username'=>'coordenacao',
                'email' => 'teste@coordenador.gov.br',
                'password' => Hash::make('coordenacao123#'),
                'escola_id' => 1,
                'role_id' => $coordenadorRoleId,
            ],
            // Professor
            [
                'name' => 'Professor',
                'username'=>'professor',
                'email' => 'teste@professor.gov.br',
                'password' => Hash::make('professor123#'),
                'escola_id' => 1,
                'role_id' => $professorRoleId,
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