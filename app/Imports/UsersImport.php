<?php

namespace App\Imports;

use App\Models\PreRegistro;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Mail;
use App\Mail\AtivacaoContaMail;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows
{
    use Importable;

    protected $escolaId;
    protected $rowCount = 0;
    protected $errors = [];

    public function __construct($escolaId)
    {
        $this->escolaId = $escolaId;
    }

    private function limparContato($contato)
    {
         return preg_replace('/[^0-9]/', '', (string) $contato);
    }

    public function collection(Collection $rows)
    {
        $filteredRows = $rows->filter(function ($row) {
            return isset($row['nome']) &&
                   !empty(trim($row['nome'])) &&
                   isset($row['email_pessoal']) &&
                   !empty(trim($row['email_pessoal']));
        });

        \Log::info('=== INICIANDO IMPORTAÇÃO ===');
        \Log::info('Total de linhas na planilha: ' . $rows->count());
        \Log::info('Linhas válidas: ' . $filteredRows->count());

        if ($filteredRows->count() === 0) {
            \Log::warning('Nenhuma linha válida encontrada.');
            return;
        }

        foreach ($filteredRows as $index => $row) {
            try {
                \Log::info("Processando linha: " . json_encode($row));

                $this->validarDados($row);

                $emailInstitucional = $this->gerarEmailInstitucional(
                    $row['nome'], 
                    $row['acesso']
                );

                $role = Role::where('acesso', $row['acesso'])->first();

                if (!$role) {
                    throw new \Exception("Função não encontrada");
                }

                $preRegistro = PreRegistro::create([
                    'nome' => $row['nome'],
                    'cpf' => $row['cpf'],
                    'data_nascimento' => $row['data_nascimento'],
                    'email_pessoal' => $row['email_pessoal'],
                    'contato' => $this->limparContato($row['contato']),
                    'email_institucional' => $emailInstitucional,
                    'escola_id' => $this->escolaId,
                    'role_id' => $role->id,
                    'status' => 'pendente',
                ]);

                Mail::to($preRegistro->email_pessoal)->send(new AtivacaoContaMail($preRegistro));

                $this->rowCount++;

            } catch (\Exception $e) {
                \Log::error('ERRO: ' . $e->getMessage());
                $this->errors[] = "Linha " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        \Log::info("Importação concluída: " . $this->rowCount . " registros");

        if (!empty($this->errors)) {
            throw new \Exception(implode("\n", $this->errors));
        }
    }

    public function rules(): array
    {
        return [
            '*.nome' => 'nullable|string|max:255',
            '*.cpf' => 'nullable|string|max:14',
            '*.data_nascimento' => 'nullable|date',
            '*.acesso' => 'nullable|in:professor,coordenador,direcao,secretaria',
            '*.email_pessoal' => 'nullable|email',
            '*.contato' => 'nullable|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $messages = [];
        foreach ($failures as $failure) {
            $messages[] = "Linha {$failure->row()}: " . implode(', ', $failure->errors());
        }
        throw new \Exception(implode("\n", $messages));
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
        
        while (PreRegistro::where('email_institucional', $finalEmail)->exists()) {
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
        $camposObrigatorios = ['nome', 'cpf', 'data_nascimento', 'acesso', 'email_pessoal', 'contato'];
        foreach ($camposObrigatorios as $campo) {
            if (!isset($row[$campo]) || empty($row[$campo])) {
                throw new \Exception("Campo obrigatório '{$campo}' está vazio");
            }
        }

        $contato = $this->limparContato($row['contato']);

    if (strlen($contato) < 8 || strlen($contato) > 12) {
        throw new \Exception("Contato inválido: informe um número com 8 a 12 dígitos");
    }


        if ($row['acesso'] === 'admin') {
            throw new \Exception('Não é permitido criar usuários admin via planilha');
        }

        if (PreRegistro::where('cpf', $row['cpf'])->exists()) {
            throw new \Exception("CPF já cadastrado");
        }

        if (PreRegistro::where('email_pessoal', $row['email_pessoal'])->exists()) {
            throw new \Exception("Email pessoal já cadastrado");
        }
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}