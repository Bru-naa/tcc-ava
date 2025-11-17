<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
  use HasFactory;

  protected $fillable = [
    'curso_id',
    'nome_turma',
    'turno',
    'ano_letivo',
    'status'
  ];

  public function curso(){
    return $this->belongsTo(Curso::class);
  }

  public function matriculas(){
    return $this->hasMany(Matricula::class);
  }
}

