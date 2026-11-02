<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Aluno extends Model
{
    use HasFactory;
     
    protected $table = 'alunos';
    
    protected $fillable = [
        'alun_nome',
        'alun_email',
        'alun_data_nascimento',
        'alun_telefone',
        'alun_cpf',
        'alun_endereco',
        'alun_sexo',
        'status'
    ];

    protected $casts = [
        'alun_data_nascimento' => 'date',
    ];

public function matriculas(): HasMany
{
    return $this->hasMany(Matricula::class);
}

public function matriculaAtiva(): HasOne
{
    return $this->hasOne(Matricula::class)
              ->where('status', 'ativa')
              ->latestOfMany('data_matricula');
}

public function cursos(): BelongsToMany
{
    return $this->belongsToMany(Curso::class, 'matriculas')
                ->withPivot(['id', 'codigo_matricula', 'turma_id', 'data_matricula', 'status'])
               
                ->withTimestamps(); 
            }


// Curso atual
public function cursoAtual(): BelongsToMany
{
    return $this->cursos()->wherePivot('status', 'ativa');
}

public function possuiVinculoAtivo(): bool
{
    return $this->matriculaAtiva()->exists();
}

}
