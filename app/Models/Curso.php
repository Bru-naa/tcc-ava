<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    USE HasFactory;

    protected $fillable = [
        'escola_id',
        'nome_curso',
        'descricao_curso',
        'duracao_curso',
        'nivel_curso',
        'ativo'
    ];

    public function escola(){
        return $this->belongsTo(Escola::class);
    }

    public function turmas(){
        return $this->hasMany(Turma::class);
    }
}
