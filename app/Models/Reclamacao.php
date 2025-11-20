<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reclamacao extends Model
{
    protected $table = 'reclamacoes';

    protected $fillable = [
        'assunto',
        'descricao',
        'status',
        'data_reclamacao',
        'data_resolucao',
        'prioridade',
        'user_id',
        'matricula_id',
        'escola_id'
    ];

    protected $casts = [
        'data_reclamacao' => 'datetime',
        'data_resolucao' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function matricula(): BelongsTo
    {
        return $this->belongsTo(Matricula::class);
    }

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }
}