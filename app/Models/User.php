<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email', // Será o email_institucional
        'status_ativacao',
        'escola_id',
        'role_id',
        'pre_registro_id',
        'password',
        'tema',
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
            'tema' => 'boolean',
        ];
    }

    public function initials(): string
    {
        $parts = preg_split('/\s+/', trim((string) $this->name));
        $initials = '';

        foreach ($parts as $p) {
            if ($p !== '') {
                $initials .= strtoupper(substr($p, 0, 1));
            }
        }

        return $initials;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }

    public function preRegistro(): BelongsTo
    {
        return $this->belongsTo(PreCadastro::class, 'pre_registro_id');
    }

    public function preCadastro(): BelongsTo
    {
        return $this->belongsTo(PreCadastro::class, 'pre_registro_id');
    }

    public function cursosCoordenados(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'coord_perfil', 'user_id', 'curso_id')
            ->withTimestamps();
    }

    public function cursosLecionados(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'curso_professor', 'user_id', 'curso_id')
            ->withTimestamps();
    }

    public function possuiPerfil(string ...$perfis): bool
    {
        return in_array($this->role?->acesso, $perfis, true);
    }
}