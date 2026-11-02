<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PreCadastro extends Model
{
    protected $table = 'pre_registros';

    public const DOMINIOS_POR_PERFIL = [
        'aluno' => '@aluno.gov.br',
        'professor' => '@professor.gov.br',
        'coordenador' => '@coordenacao.gov.br',
        'direcao' => '@direcao.gov.br',
        'secretaria' => '@secretaria.gov.br',
    ];

    protected $fillable = [
        'nome',
        'telefone',
        'data_nascimento',
        'cpf', 
        'email_pessoal',
        'email_institucional',
        'escola_id',
        'role_id',
        'criado_por',
         'status',
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    //  PRÉ-CADASTRO COM EMAIL INSTITUCIONAL
    public static function criarComEmailInstitucional(array $dados): self
    {
        $cpf = preg_replace('/\D/', '', $dados['cpf']);
        $telefone = isset($dados['telefone']) ? preg_replace('/\D/', '', $dados['telefone']) : null;
        
                $emailInstitucional = self::gerarEmailInstitucional($dados['nome'], (int) $dados['role_id']);

        return self::create([
            'nome' => $dados['nome'],
            'telefone' => $telefone,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'cpf' => $cpf,
            'email_pessoal' => $dados['email_pessoal'],
            'email_institucional' => $emailInstitucional,
            'escola_id' => $dados['escola_id'],
            'role_id' => $dados['role_id'],
            'status' => 'pendente',
            'criado_por' => Auth::user()?->name ?? ($dados ['criado_por'] ?? 'Sistema'),
        
        ]);
    }

    // EMAIL INSTITUCIONAL AUTOMATICAMENTE
    public static function gerarEmailInstitucional(string $nome, int $role_id): string
    {
        $role = Role::findOrFail($role_id);
        $acesso = $role->acesso ?? 'aluno';

        $domain = self::DOMINIOS_POR_PERFIL[$acesso] ?? '@escola.gov.br';
        $username = Str::slug(self::extrairPrimeiroUltimoNome($nome), '.');
        $finalEmail = $username . $domain;

        $counter = 1;
        while (self::where('email_institucional',$finalEmail)->exists()){
            $finalEmail = $username . $counter . $domain;
            $counter++;
        }

        return $finalEmail;
    }

    
    private static function extrairPrimeiroUltimoNome(string $nomeCompleto): string 
   {
        $nomes = preg_split('/\s+/', trim ($nomeCompleto));
        return count($nomes) === 1 ? $nomes[0] : $nomes[0] . '.' . end($nomes);
    }

    // SCOPES ÚTEIS
    public function scopePendentes(Builder $query): Builder
    {
        return $query->where('status', 'pendente');
    }

    public function scopeAprovados(Builder $query): Builder
    {
        return $query->where('status', 'aprovado');
    }

    public function scopeAtivados(Builder $query): Builder
    {
        return $query->where('status', 'ativado');

    }

    public function scopeDaEscola (Builder $query, int $escola_id): Builder
    {
        return $query->where('escola_id', $escola_id);
    }

    // RELACIONAMENTOS
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'pre_registro_id');
    }

    
    public function getCpfFormatadoAttribute(): string
    {
       return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', (string) $this->cpf);
    }

    public function getTelefoneFormatadoAttribute(): ?string
    {
     if ($this->telefone && strlen ($this->telefone)=== 11){
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->telefone);
        }
        return $this->telefone;
    }
    public function getStatusFormatadoAttribute(): string
    {
        return match($this->status) {
            'pendente' => 'Pendente',
            'aprovado' => 'Aprovado',
            'ativado'  => 'Ativado',
            'rejeitado' => 'Rejeitado',
            default => (string) $this->status,
        };
    }
}