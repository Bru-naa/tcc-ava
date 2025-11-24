<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasAvaliacao extends Model
{
 
    protected $table = 'perguntas_avaliacao';
    
    protected $fillable = [
        'pergunta',
        'tipo',
        'opcoes',
        'ordem', 
        'ativo'
    ];

    protected $casts = [
        'opcoes' => 'array',
        'ativo' => 'boolean'
    ];

    // Scope para perguntas ativas
    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }

    // Ordenar por ordem
    public function scopeOrdenadas($query)
    {
        return $query->orderBy('ordem');
    }

    // Relacionamento com respostas
    public function respostas()
    {
        return $this->hasMany(RespostaAvaliacao::class, 'pergunta_id');
    }
}
