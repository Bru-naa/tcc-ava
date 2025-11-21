<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SenhaTemporariaMail;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable;

    protected $escolaId;
    protected $rowCount = 0;
    protected $errors = [];

    public function __construct($escolaId)
    {
        $this->escolaId = $escolaId;
    }

    public function collection(Collection $rows)
    {
        \Log::info('=== INICIANDO IMPORTAÇÃO ===');
        \Log::info('Total de linhas na planilha: ' . $rows->count());
        \Log::info('Escola ID: ' . $this->escolaId);
        
        foreach ($rows as $index => $row) {
            try {
                \Log::info("--- Processando linha " . ($index + 2) . " ---");
                \Log::info('Dados da linha: ' . json_encode($row));
                
                // Validação manual adicional
                $this->validarDados($row);

                \Log::info('✅ Dados válidos');

                $emailInstitucional = $this->gerarEmailInstitucional(
                    $row['nome'], 
                    $row['acesso']
                );

                \Log::info('Email institucional gerado: ' . $emailInstitucional);

                $role = Role::where('acesso', $row['acesso'])->first();

                if (!$role) {
                    throw new \Exception("Função '{$row['acesso']}' não encontrada no sistema");
                }

                \Log::info('Role encontrada: ' . $role->acesso . ' (ID: ' . $role->id . ')');

                \Log::info('Tentando criar usuário no banco...');
                
                // Cria o usuário e armazena em variável para debug
               $senhaTemporaria = Str::random(8);

$user = User::create([
    'nome' => $row['nome'],
    'cpf' => $row['cpf'],
    'data_nascimento' => $row['data_nascimento'],
    'acesso' => $row['acesso'],
    'email' => $row['email_pessoal'],
    'email_institucional' => $emailInstitucional,
    'contato' => $row['contato'],
    'escola_id' => $this->escolaId,
    'role_id' => $role->id,
    'status' => 'pendente',
    'password' => Hash::make($senhaTemporaria),
]);

// Adicione o envio de email aqui
Mail::to($user->email)->send(new SenhaTemporariaMail($senhaTemporaria, $emailInstitucional));

                \Log::info('🎉 USUÁRIO CRIADO COM SUCESSO! ID: ' . $user->id);
                $this->rowCount++;

            } catch (\Exception $e) {
                \Log::error('❌ ERRO na linha ' . ($index + 2) . ': ' . $e->getMessage());
                $this->errors[] = "Linha " . ($index + 2) . ": " . $e->getMessage();
            }
        }

        \Log::info("=== IMPORTAÇÃO CONCLUÍDA ===");
        \Log::info("Total de usuários criados: " . $this->rowCount);
        \Log::info("Total de erros: " . count($this->errors));

        if (!empty($this->errors)) {
            \Log::error("Erros encontrados: " . implode(" | ", $this->errors));
            throw new \Exception(implode("\n", $this->errors));
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
        \Log::info('Validando dados...');

        // Verifica se todos os campos obrigatórios existem
        $camposObrigatorios = ['nome', 'cpf', 'data_nascimento', 'acesso', 'email_pessoal', 'contato'];
        foreach ($camposObrigatorios as $campo) {
            if (!isset($row[$campo]) || empty($row[$campo])) {
                throw new \Exception("Campo obrigatório '{$campo}' está vazio ou não existe");
            }
        }

        if ($row['acesso'] === 'admin') {
            throw new \Exception('Não é permitido criar usuários admin via planilha');
        }

        if (User::where('cpf', $row['cpf'])->exists()) {
            throw new \Exception("CPF {$row['cpf']} já cadastrado");
        }

        if (User::where('email', $row['email_pessoal'])->exists()) {
            throw new \Exception("Email pessoal {$row['email_pessoal']} já cadastrado");
        }

        \Log::info('✅ Validação concluída com sucesso');
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}