<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Escola;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $escola = Escola::first();
        
        Curso::insert([
            [
                'nome_curso' => 'Técnico em Redes de Computadores',
                'sigla' => 'TRC',
                'descricao_curso' => 'Curso técnico focado em redes de computadores, incluindo configuração, manutenção e segurança de redes.',
                'duracao_curso' => 12,
                'nivel_curso' => 'Técnico',
                'area_curso' => 'TI',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_curso' => 'Técnico em Desenvolvimento de Software',
                'sigla' => 'TDS',
                'descricao_curso' => 'Curso técnico focado em desenvolvimento de software, incluindo programação, design de software e metodologias ágeis.',
                'duracao_curso' => 18,
                'nivel_curso' => 'Técnico',
                'area_curso' => 'TI',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_curso' => 'Técnico em Enfermagem',
                'sigla' => 'TENF',
                'descricao_curso' => 'Curso técnico em enfermagem, preparando para cuidados com pacientes, procedimentos médicos e saúde coletiva.',
                'duracao_curso' => 24,
                'nivel_curso' => 'Técnico',
                'area_curso' => 'Saúde',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_curso' => 'Técnico em Administração',
                'sigla' => 'TADM',
                'descricao_curso' => 'Curso técnico em administração, abordando gestão empresarial, recursos humanos e finanças.',
                'duracao_curso' => 18,
                'nivel_curso' => 'Técnico',
                'area_curso' => 'Gestão',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_curso' => 'Técnico em Segurança do Trabalho',
                'sigla' => 'TST',
                'descricao_curso' => 'Curso técnico em segurança do trabalho, focando em prevenção de acidentes, normas regulamentadoras e saúde ocupacional.',
                'duracao_curso' => 18,
                'nivel_curso' => 'Técnico',
                'area_curso' => 'Segurança',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_curso' => 'Ensino Médio Regular',
                'sigla' => 'EMR',
                'descricao_curso' => 'Ensino Médio Regular com formação básica completa.',
                'duracao_curso' => 36,
                'nivel_curso' => 'Médio',
                'area_curso' => 'Educação Básica',
                'escola_id' => $escola->id,
                'ativo' => true,
                'ultimo_numero' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}