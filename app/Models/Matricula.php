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
        'status'
    ];
    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }

    public function turma(){
        return $this->belongsTo(Turma::class);
    }
}
