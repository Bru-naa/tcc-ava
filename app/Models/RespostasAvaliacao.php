<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RespostasAvaliacao extends Model
{
    protected $table = 'respostas_avaliacao';

    protected $fillable = [
        'pergunta_id',
        'periodo',
        'resposta',
        'session_id',
    ];

    public function pergunta(): BelongsTo
    {
        return $this->belongsTo(PerguntasAvaliacao::class, 'pergunta_id');
    }

    public function scopePorPeriodo(Builder $query, string $periodo): Builder
    {
        return $query->where('periodo', $periodo);
    }

    // BUSCAR DADOS PARA DASHBOARD (Agregado via SQL GROUP BY)
    public static function getDadosDashboard(string $periodo): array
    {
        $agrupados = self::query()
            ->porPeriodo($periodo)
            ->whereIn('pergunta_id', [1, 2, 3, 4])
            ->select('pergunta_id', 'resposta', DB::raw('COUNT(*) as total'))
            ->groupBy('pergunta_id', 'resposta')
            ->get()
            ->groupBy('pergunta_id');

        return [
            'participacao_atividades' => self::extrairContagem($agrupados, 1),
            'dificuldades_ensino' => self::extrairContagem($agrupados, 2),
            'conforto_duvidas' => self::extrairContagem($agrupados, 3),
            'coerencia_avaliacoes' => self::extrairContagem($agrupados, 4),
        ];
    }

    private static function extrairContagem(Collection $agrupados, int $perguntaId): array
    {
        if (! $agrupados->has($perguntaId)) {
            return [];
        }

        return $agrupados->get($perguntaId)
            ->pluck('total', 'resposta')
            ->map(fn ($total) => (int) $total)
            ->toArray();
    }
}