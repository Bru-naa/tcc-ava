<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

public function matriculas()
{
    return $this->hasMany(Matricula::class);
}

public function matriculaAtiva()
{
    return $this->hasOne(Matricula::class)->where('status', 'ativa');
}

public function cursos(): BelongsToMany
{
    return $this->belongsToMany(Curso::class, 'matriculas');
}


// Curso atual
public function cursoAtual()
{
    return $this->belongsToMany(Curso::class, 'matriculas')
                ->wherePivot('status', 'ativo');
}
}
