<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;

    protected $escolaId;
    protected $rowCount = 0;

    public function __construct($escolaId)
    {
        $this->escolaId = $escolaId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->validarDados($row);

            $emailInstitucional = $this->gerarEmailInstitucional(
                $row['nome'], 
                $row['acesso']
            );

            User::create([
                'nome' => $row['nome'],
                'cpf' => $row['cpf'],
                'data_nascimento' => $row['data_nascimento'],
                'acesso' => $row['acesso'],
                'email' => $row['email_pessoal'],
                'email_institucional' => $emailInstitucional,
                'contato' => $row['contato'],
                'escola_id' => $this->escolaId,
                'role_id' => Role::where('acesso', $row['acesso'])->first()->id,
                'status' => 'pendente',
                'password' => null,
            ]);

            $this->rowCount++;
        }
    }

    public function rules(): array
    {
        return [
            '*.nome' => 'required|string|max:255',
            '*.cpf' => 'required|string|max:14',
            '*.data_nascimento' => 'required|date',
            '*.acesso' => 'required|in:professor,coordenador,direcao,secretaria',
            '*.email_pessoal' => 'required|email',
            '*.contato' => 'required|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        throw new \Maatwebsite\Excel\Validators\ValidationException(
            \Illuminate\Validation\ValidationException::withMessages([])
        );
    }

    private function gerarEmailInstitucional($nome, $acesso)
    {
        $domains = [
            'professor' => '@professor.gov.br',
            'coordenador' => '@coordenacao.gov.br',
            'direcao' => '@direcao.gov.br',
            'secretaria' => '@secretaria.gov.br'
        ];

        $domain = $domains[$acesso] ?? '@escola.gov.br';
        
        $username = Str::slug($this->extrairPrimeiroUltimoNome($nome), '.');
        $baseEmail = $username . $domain;
        
        $counter = 1;
        $finalEmail = $baseEmail;
        
        while (User::where('email_institucional', $finalEmail)->exists()) {
            $finalEmail = $username . $counter . $domain;
            $counter++;
        }
        
        return $finalEmail;
    }

    private function extrairPrimeiroUltimoNome($nomeCompleto)
    {
        $nomes = explode(' ', trim($nomeCompleto));
        
        if (count($nomes) == 1) {
            return $nomes[0];
        }
        
        $primeiroNome = $nomes[0];
        $ultimoNome = end($nomes);
        
        return $primeiroNome . '.' . $ultimoNome;
    }

    private function validarDados($row)
    {
        if ($row['acesso'] === 'admin') {
            throw new \Exception('Não é permitido criar usuários admin via planilha');
        }

        if (User::where('cpf', $row['cpf'])->exists()) {
            throw new \Exception("CPF {$row['cpf']} já cadastrado");
        }

        if (User::where('email', $row['email_pessoal'])->exists()) {
            throw new \Exception("Email pessoal {$row['email_pessoal']} já cadastrado");
        }
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}