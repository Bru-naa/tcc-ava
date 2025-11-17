<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;

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

    public function matriculas(){
        return $this->hasMany(Matricula::class);
    }
}
