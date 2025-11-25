<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PreCadastro extends Model
{
    protected $table = 'pre_registros';

    protected $fillable = [
        'nome', 'telefone', 'data_nascimento', 'cpf', 
        'email_pessoal', 'email_institucional',
        'escola_id', 'role_id', 'criado_por','user_id','status'
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];

    //  PRÉ-CADASTRO COM EMAIL INSTITUCIONAL
    public static function criarComEmailInstitucional(array $dados)
    {
        $cpf = preg_replace('/\D/', '', $dados['cpf']);
        $telefone = preg_replace('/\D/', '', $dados['telefone']);
        
        $emailInstitucional = self::gerarEmailInstitucional($dados['nome'], $dados['role_id']);

        return self::create([
            'nome' => $dados['nome'],
            'telefone' => $telefone,
            'data_nascimento' => $dados['data_nascimento'],
            'cpf' => $cpf,
            'email_pessoal' => $dados['email_pessoal'],
            'email_institucional' => $emailInstitucional,
            'escola_id' => $dados['escola_id'],
            'role_id' => $dados['role_id'],
            'status' => 'pendente',
            'criado_por' => Auth::user()->name,
            'user_id' => Auth::id(),
        ]);
    }

    // EMAIL INSTITUCIONAL AUTOMATICAMENTE
    public static function gerarEmailInstitucional($nome, $role_id)
    {
        $role = Role::findOrFail($role_id);
        $acesso = $role->acesso ?? 'escola';

        $domains = [
            'professor' => '@professor.gov.br',
            'coordenador' => '@coordenacao.gov.br',
            'direcao' => '@direcao.gov.br',
            'secretaria' => '@secretaria.gov.br',
            'admin' => '@administracao.gov.br',
            'escola' => '@escola.gov.br'
        ];

        $domain = $domains[$acesso] ?? '@escola.gov.br';
        $username = Str::slug(self::extrairPrimeiroUltimoNome($nome), '.');
        $finalEmail = $username . $domain;

        $counter = 1;
        while (self::where('email_institucional', $finalEmail)->exists()) {
            $finalEmail = $username . $counter . $domain;
            $counter++;
        }

        return $finalEmail;
    }

    
    private static function extrairPrimeiroUltimoNome($nomeCompleto)
    {
        $nomes = explode(' ', trim($nomeCompleto));
        return count($nomes) === 1 ? $nomes[0] : $nomes[0] . '.' . end($nomes);
    }

    // SCOPES ÚTEIS
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeAprovados($query)
    {
        return $query->where('status', 'aprovado');
    }

    public function scopeDaEscola($query, $escola_id)
    {
        return $query->where('escola_id', $escola_id);
    }

    // RELACIONAMENTOS
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
        return $this->hasOne(User::class);
    }

    
    public function getCpfFormatadoAttribute()
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
    }

    public function getTelefoneFormatadoAttribute()
    {
        if (strlen($this->telefone) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->telefone);
        }
        return $this->telefone;
    }

    public function getStatusFormatadoAttribute()
    {
        return match($this->status) {
            'pendente' => 'Pendente',
            'aprovado' => 'Aprovado',
            'rejeitado' => 'Rejeitado',
            default => $this->status
        };
    }
}