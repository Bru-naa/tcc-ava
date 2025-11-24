<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAvaliacao extends Model

{
    protected $table = 'status_avaliacoes';
    
    protected $fillable = [
        'periodo',
        'aberta', 
        'aberto_por',
        'fechado_por',
        'data_abertura',
        'data_fechamento',
        'observacoes'
    ];

    protected $casts = [
        'aberta' => 'boolean',
        'data_abertura' => 'date',
        'data_fechamento' => 'date'
    ];

    // Scope para avaliações abertas
    public function scopeAbertas($query)
    {
        return $query->where('aberta', true);
    }

    // Verificar se período está aberto
    public static function periodoEstaAberto($periodo)
    {
        return self::where('periodo', $periodo)
            ->where('aberta', true)
            ->exists();
    }
}
