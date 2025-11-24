<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostasAvaliacao extends Model
{
    protected $table = 'respostas_avaliacao';
    
    protected $fillable = [
        'pergunta_id',
        'periodo', 
        'resposta',
        'session_id'
    ];

    public function pergunta()
    {
        return $this->belongsTo(PerguntaAvaliacao::class, 'pergunta_id');
    }

    public function scopePorPeriodo($query, $periodo)
    {
        return $query->where('periodo', $periodo);
    }

    // BUSCAR DADOS PARA DASHBOARD
    public static function getDadosDashboard($periodo)
    {
        $respostas = self::with('pergunta')
            ->porPeriodo($periodo)
            ->get();

        return [
            // Pergunta 1 - Pizza/Barra
            'participacao_atividades' => self::processarRespostas($respostas, 1),
            
            // Pergunta 2 - Barras Horizontais  
            'dificuldades_ensino' => self::processarRespostas($respostas, 2),
            
            // Pergunta 3 - Pizza/Barra
            'conforto_duvidas' => self::processarRespostas($respostas, 3),
            
            // Pergunta 4 - Barra Escala
            'coerencia_avaliacoes' => self::processarRespostas($respostas, 4)
        ];
    }

    private static function processarRespostas($respostas, $perguntaId)
    {
        return $respostas->where('pergunta_id', $perguntaId)
            ->groupBy('resposta')
            ->map->count()
            ->toArray();
    }
}