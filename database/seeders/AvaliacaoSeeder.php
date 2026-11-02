<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusAvaliacao;
use App\Models\PerguntasAvaliacao;
use Illuminate\Support\Facades\Schema;

class AvaliacaoSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        StatusAvaliacao::truncate();
        PerguntasAvaliacao::truncate();
        Schema::enableForeignKeyConstraints();

        // Períodos de 2025
        $periodos = [
            [
                'periodo' => '2025-1',
                'aberta' => true,
                'aberto_por' => 'Sistema',
                'data_abertura' => now(),
                'observacoes' => 'Avaliação do 1º semestre de 2025'
            ],
            [
                'periodo' => '2025-2', 
                'aberta' => false,
                'aberto_por' => 'Sistema',
                'data_abertura' => now(),
                'observacoes' => 'Avaliação do 2º semestre de 2025'
            ]
        ];

        foreach ($periodos as $periodo) {
            StatusAvaliacao::create($periodo);
        }

        
        $perguntas = [
            [
                'pergunta' => 'Como aluno, você realiza todas as atividades práticas incentivadas durante a aula?',
                'tipo' => 'escala',
                'opcoes' => json_encode(['Não', 'A maioria das vezes', 'Sempre participo']),
                'ordem' => 1,
                'ativo' => true
            ],
            [
                'pergunta' => 'Quais dificuldades você sente em relação ao ensino do professor(a)?',
                'tipo' => 'multipla_escolha',
                'opcoes' => json_encode([
                    'Ritmo da aula (muito rápido ou muito lento)',
                    'Explicação rápida ou pouco clara', 
                    'Poucos exemplos ou atividades práticas',
                    'Conteúdo desorganizado',
                    'Nenhuma das acima'
                ]),
                'ordem' => 2,
                'ativo' => true
            ],
            [
                'pergunta' => 'Quando sente dificuldade, você se sente à vontade para tirar dúvidas com o professor(a)?',
                'tipo' => 'escala',
                'opcoes' => json_encode(['Não', 'Às vezes', 'Sim']),
                'ordem' => 3,
                'ativo' => true
            ],
            [
                'pergunta' => 'A forma de avaliação (provas, trabalhos, atividades) é justa e coerente com o que foi ensinado?',
                'tipo' => 'escala',
                'opcoes' => json_encode([
                    'Sim, totalmente',
                    'Em sua maioria, sim', 
                    'Parcialmente coerente',
                    'Não, a avaliação não reflete o conteúdo ensinado'
                ]),
                'ordem' => 4,
                'ativo' => true
            ]
        ];

        foreach ($perguntas as $pergunta) {
            PerguntasAvaliacao::create($pergunta);
        }

        $this->command->info('✅ PERÍODOS 2025 criados com sucesso!');
        $this->command->info('📅 Períodos: 2025-1 (ABERTO) e 2025-2 (FECHADO)');
        $this->command->info('❓ 4 Perguntas formatadas cadastradas');
        $this->command->info('');
        $this->command->info('📊 TIPOS DE GRÁFICOS POR PERGUNTA:');
        $this->command->info('1. Pizza/Barra - Participação atividades');
        $this->command->info('2. Barras Horizontais - Dificuldens ensino'); 
        $this->command->info('3. Pizza/Barra - Conforto dúvidas');
        $this->command->info('4. Barra Escala - Coerência avaliações');
    }
}