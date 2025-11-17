<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escola extends Model
{
   use HasFactory; // para testes

   protected $fillable = [
    'esc_nome',
    'esc_endereco',
    'esc_telefone',
    'esc_email',
    'esc_codigo',
    'ativo',
    'esc_tipo',
    'regional_id'
   ];

   public function cursos ()
   {
    return $this->hasMany(Curso::class);
   }
   public function regional()
{
    return $this->belongsTo(Regional::class);
}
}
