<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'acesso' => 'admin', // ← ADMIN AQUI TAMBÉM
                'description' => 'Acesso total ao sistema'
            ],
            [
                'name' => 'Secretaria',
                'acesso' => 'secretaria', 
                'description' => 'Acesso a cadastros e relatórios administrativos'
            ],
            [
                'name' => 'Direção',
                'acesso' => 'direcao',
                'description' => 'Acesso a relatórios gerenciais e dados institucionais'
            ],
            [
                'name' => 'Coordenação',
                'acesso' => 'coordenador',
                'description' => 'Acesso pedagógico e acompanhamento de professores'
            ],
            [
                'name' => 'Professor',
                'acesso' => 'professor',
                'description' => 'Acesso às turmas, alunos e lançamento de notas'
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['acesso' => $role['acesso']],
                $role
            );
        }
    }
}