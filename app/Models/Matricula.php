<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_matricula',
        'aluno_id',
        'curso_id',
        'turma_id',
        'data_matricula',
        'status',
        
    ];
       protected $casts = [
        'data_matricula' => 'date'
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function turma(): BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    public function reclamacoes(): HasMany
    {
        return $this->hasMany(Reclamacao::class);
    }

    // Scopes úteis
    public function scopeAtiva(Builder $query): Builder
    {
        return $query->where('status', 'ativa');
    }

    public function scopeTrancada(Builder $query): Builder
    {
        return $query->where('status', 'trancada');
    }

    public function scopeConcluida(Builder $query): Builder
    {
        return $query->where('status', 'concluida');
    }

    public function scopeTransferido(Builder $query): Builder
    {
        return $query->where('status', 'transferido');
    }


}
