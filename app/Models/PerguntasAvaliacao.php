<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerguntasAvaliacao extends Model
{
    protected $table = 'perguntas_avaliacao';

    protected $fillable = [
        'pergunta',
        'tipo',
        'opcoes',
        'ordem',
        'ativo',
    ];

    protected $casts = [
        'opcoes' => 'array',
        'ativo' => 'boolean',
    ];

    public function scopeAtivas(Builder $query): Builder
    {
        return $query->where('ativo', true);
    }

    public function scopeOrdenadas(Builder $query): Builder
    {
        return $query->orderBy('ordem');
    }

    public function respostas(): HasMany
    {
        return $this->hasMany(RespostasAvaliacao::class, 'pergunta_id');
    }
}