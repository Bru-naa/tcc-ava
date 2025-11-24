<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',     
        'email',    //  Será o email_institucional
        'status_ativacao',
        'escola_id',
        'password',
        'role_id',
       
    ];

    protected $hidden = [
        'password',
        'two_factor_secret', 
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tema' => 'boolean', // campo tema
        ];
    }

    public function initials()
    {
        $parts = explode(' ', $this->name);
        $initials = '';

        foreach ($parts as $p) {
            $initials .= strtoupper(substr($p, 0, 1));
        }

        return $initials;
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
     public function preRegistro()
    {
        return $this->belongsTo(PreRegistro::class);
    }

   
   
}