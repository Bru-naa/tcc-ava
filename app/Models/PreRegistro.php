<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreRegistro extends Model
{
    protected $table = 'pre_registros';

    protected $fillable = [
        'nome', 'telefone', 'data_nascimento', 'cpf', 
        'email_pessoal', 'email_institucional',
        'escola_id', 'role_id', 'criado_por','user_id','status'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email_institucional');
    }
}