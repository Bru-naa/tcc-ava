<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'escola_id',
        'nome_curso',
        'descricao_curso',
        'duracao_curso',
        'nivel_curso',
        'sigla',
        'area_curso',
        'ultimo_numero',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'duracao_curso' => 'integer',
        'ultimo_numero' => 'integer'
    ];

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class);
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'matriculas');
    }

    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function scopePorNivel($query, $nivel)
    {
        return $query->where('nivel_curso', $nivel);
    }

    public function scopePorArea($query, $area)
    {
        return $query->where('area_curso', $area);
    }

    public function gerarNumeroMatricula()
    {
        $this->ultimo_numero = ($this->ultimo_numero ?? 0) + 1;
        $this->save();

        return $this->sigla . str_pad($this->ultimo_numero, 5, '0', STR_PAD_LEFT);
    }

    public function matriculaExiste($codigoMatricula)
    {
        return Matricula::where('codigo_matricula', $codigoMatricula)->exists();
    }

    public function gerarMatriculaUnica()
    {
        do {
            $codigoMatricula = $this->gerarNumeroMatricula();
        } while ($this->matriculaExiste($codigoMatricula));

        return $codigoMatricula;
    }

    public static function validarSigla($sigla)
    {
        return (bool) preg_match('/^[A-Z0-9]{3,4}$/', $sigla);
    }

    public function getDuracaoFormatadaAttribute()
    {
        $meses = $this->duracao_curso;

        if ($meses >= 12) {
            $anos = floor($meses / 12);
            $resto = $meses % 12;

            if ($resto > 0) {
                return "{$anos} ano" . ($anos > 1 ? 's' : '') .
                       " e {$resto} mês" . ($resto > 1 ? 'es' : '');
            }

            return "{$anos} ano" . ($anos > 1 ? 's' : '');
        }

        return "{$meses} mês" . ($meses > 1 ? 'es' : '');
    }
}
