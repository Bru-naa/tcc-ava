<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'turma_id',
        'data_matricula',
        'status',
        'codigo_matricula'
        
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

    // Scopes úteis
    public function scopeAtivo($query)
    {
        return $query->where('status', 'ativo');
    }

    public function scopeInativo($query)
    {
        return $query->where('status', 'inativo');
    }

    public function scopeConcluido($query)
    {
        return $query->where('status', 'concluido');
    }


}
