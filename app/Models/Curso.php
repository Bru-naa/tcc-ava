<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }

    public function alunos(): BelongsToMany
    {
        return $this->belongsToMany(Aluno::class, 'matriculas')
                    ->withPivot(['id', 'codigo_matricula', 'turma_id', 'data_matricula', 'status'])
                   
                    ->withTimestamps();
                }

    public function coordenadores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coord_perfil', 'curso_id', 'user_id')
            ->withTimestamps();
    }

    public function professores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'curso_professor', 'curso_id', 'user_id')
            ->withTimestamps();
    }

    public function scopeAtivo(Builder $query): Builder
    {
        return $query->where('ativo', true);
    }            

     public function scopeDaEscola(Builder $query, int $escolaId): Builder
    {
        return $query->where('escola_id', $escolaId);
    }
    public function scopePorNivel(Builder $query, string $nivel): Builder
    {
        return $query->where('nivel_curso', $nivel);
    }
    public function scopePorArea(Builder $query, string $area): Builder
    {
        return $query->where('area_curso', $area);
    }

       public function gerarMatriculaUnica(): string
    {
        return DB::transaction(function () {
            $curso = self::whereKey($this->id)->lockForUpdate()->firstOrFail();

            do {
                $curso->ultimo_numero = ($curso->ultimo_numero ?? 0) + 1;
                $codigoMatricula = $curso->sigla . str_pad((string) $curso->ultimo_numero, 5, '0', STR_PAD_LEFT);
            } while ($this->matriculaExiste($codigoMatricula));

            $curso->save();
            $this->ultimo_numero = $curso->ultimo_numero;

            return $codigoMatricula;
        });
    }

    public function matriculaExiste(string $codigoMatricula): bool
    {
        return Matricula::where('codigo_matricula', $codigoMatricula)->exists();
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
