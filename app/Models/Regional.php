<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regional extends Model
{
    use HasFactory;

    // nome correto da tabela no seu banco
    protected $table = 'regionais';

    protected $fillable = [
        'reg_nome',
        'reg_codigo',
        'reg_telefone',
        'reg_email',
        'reg_endereco',
        'reg_cidade',
        'reg_estado',
        'reg_responsavel_nome',
    ];

    public function escolas()
    {
        return $this->hasMany(Escola::class);
    }
}
