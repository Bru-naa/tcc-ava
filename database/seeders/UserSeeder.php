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

        // Vincula a Coordenadora e o Professor aos cursos de TI (TRC e TDS)
        $coordenador = User::where('email', 'teste@coordenador.gov.br')->first();
        $professor = User::where('email', 'teste@professor.gov.br')->first();
        $cursosTiIds = DB::table('cursos')->whereIn('sigla', ['TRC', 'TDS'])->pluck('id')->all();

        if ($coordenador && ! empty($cursosTiIds)) {
            $coordenador->cursosCoordenados()->syncWithoutDetaching($cursosTiIds);
        }

        if ($professor && ! empty($cursosTiIds)) {
            $professor->cursosLecionados()->syncWithoutDetaching($cursosTiIds);
        }

        // Popula alunos, matrículas e reclamações demonstrativas para testar o filtro por curso vs geral
        $cursoTdsId = DB::table('cursos')->where('sigla', 'TDS')->value('id');
        $cursoTrcId = DB::table('cursos')->where('sigla', 'TRC')->value('id');
        $cursoTadmId = DB::table('cursos')->where('sigla', 'TADM')->value('id');

        if ($cursoTdsId && $cursoTrcId && $cursoTadmId && $coordenador) {
            $aluno1Id = DB::table('alunos')->insertGetId([
                'alun_nome' => 'Lucas Almeida (TDS)',
                'alun_email' => 'lucas.tds@aluno.gov.br',
                'alun_cpf' => '11122233344',
                'alun_telefone' => '61999990001',
                'alun_data_nascimento' => '2005-04-12',
                'alun_endereco' => 'Quadra 10, Conjunto A',
                'alun_sexo' => 'masculino',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $aluno2Id = DB::table('alunos')->insertGetId([
                'alun_nome' => 'Mariana Costa (TRC)',
                'alun_email' => 'mariana.trc@aluno.gov.br',
                'alun_cpf' => '22233344455',
                'alun_telefone' => '61999990002',
                'alun_data_nascimento' => '2006-08-20',
                'alun_endereco' => 'Quadra 12, Conjunto B',
                'alun_sexo' => 'feminino',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $aluno3Id = DB::table('alunos')->insertGetId([
                'alun_nome' => 'Rafael Souza (TADM)',
                'alun_email' => 'rafael.tadm@aluno.gov.br',
                'alun_cpf' => '33344455566',
                'alun_telefone' => '61999990003',
                'alun_data_nascimento' => '2004-11-05',
                'alun_endereco' => 'Quadra 15, Conjunto C',
                'alun_sexo' => 'masculino',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $matTdsId = DB::table('matriculas')->insertGetId([
                'codigo_matricula' => 'TDS00001',
                'aluno_id' => $aluno1Id,
                'curso_id' => $cursoTdsId,
                'data_matricula' => now()->toDateString(),
                'status' => 'ativa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $matTrcId = DB::table('matriculas')->insertGetId([
                'codigo_matricula' => 'TRC00001',
                'aluno_id' => $aluno2Id,
                'curso_id' => $cursoTrcId,
                'data_matricula' => now()->toDateString(),
                'status' => 'ativa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $matTadmId = DB::table('matriculas')->insertGetId([
                'codigo_matricula' => 'TADM00001',
                'aluno_id' => $aluno3Id,
                'curso_id' => $cursoTadmId,
                'data_matricula' => now()->toDateString(),
                'status' => 'ativa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('reclamacoes')->insert([
                [
                    'assunto' => 'Laboratório de Programação — Computadores sem IDE',
                    'descricao' => 'Três máquinas do laboratório 2 estão sem ambiente PHP/VS Code configurado.',
                    'status' => 'pendente',
                    'prioridade' => 'alta',
                    'data_reclamacao' => now()->subDays(2),
                    'data_resolucao' => null,
                    'user_id' => $coordenador->id,
                    'matricula_id' => $matTdsId,
                    'escola_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'assunto' => 'Switch da Bancada de Redes com porta defeituosa',
                    'descricao' => 'O switch da bancada 3 do laboratório de redes precisa de manutenção.',
                    'status' => 'resolvida',
                    'prioridade' => 'media',
                    'data_reclamacao' => now()->subDays(5),
                    'data_resolucao' => now()->subDay(),
                    'user_id' => $coordenador->id,
                    'matricula_id' => $matTrcId,
                    'escola_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'assunto' => 'Projetor da Sala 08 (Administração) intermitente',
                    'descricao' => 'O cabo HDMI da sala do curso de Administração está com mau contato.',
                    'status' => 'pendente',
                    'prioridade' => 'baixa',
                    'data_reclamacao' => now()->subDay(),
                    'data_resolucao' => null,
                    'user_id' => $coordenador->id,
                    'matricula_id' => $matTadmId,
                    'escola_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}