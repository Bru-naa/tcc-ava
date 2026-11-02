<?php

namespace App\Imports;

use App\Models\PreCadastro;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows
{
    use Importable;

    protected int $escolaId;
    protected int $rowCount = 0;
    protected array $errors = [];

    public function __construct(int $escolaId)
    {
        $this->escolaId = $escolaId;
    }

    private function limparNumero($valor): string
    {
        return preg_replace('/\D/', '', (string) $valor);
    }

    public function collection(Collection $rows): void
    {
        $filteredRows = $rows->filter(function ($row) {
            return isset($row['nome'], $row['email_pessoal'])
                && trim((string) $row['nome']) !== ''
                && trim((string) $row['email_pessoal']) !== '';
        });

        if ($filteredRows->isEmpty()) {
            Log::warning('Nenhuma linha válida encontrada na importação.');
            return;
        }

        // Pré-carrega os perfis fora do loop (evita N+1 queries no SQLite)
        $rolesMap = Role::pluck('id', 'acesso');

        foreach ($filteredRows as $index => $row) {
            try {
                $this->validarDados($row);

                $acesso = strtolower(trim((string) $row['acesso']));
                $roleId = $rolesMap->get($acesso);

                if (! $roleId) {
                    throw new \Exception("Perfil de acesso '{$acesso}' não encontrado.");
                }

                $telefoneBruto = $row['telefone'] ?? ($row['contato'] ?? '');

                PreCadastro::criarComEmailInstitucional([
                    'nome' => trim((string) $row['nome']),
                    'cpf' => $this->limparNumero($row['cpf']),
                    'data_nascimento' => $row['data_nascimento'],
                    'email_pessoal' => trim((string) $row['email_pessoal']),
                    'telefone' => $this->limparNumero($telefoneBruto),
                    'escola_id' => $this->escolaId,
                    'role_id' => $roleId,
                ]);

                $this->rowCount++;
            } catch (\Exception $e) {
                Log::error('Erro na importação: ' . $e->getMessage());
                $this->errors[] = 'Linha ' . ($index + 2) . ': ' . $e->getMessage();
            }
        }

        if (! empty($this->errors)) {
            throw new \Exception(implode("\n", $this->errors));
        }
    }

    public function rules(): array
    {
        return [
            '*.nome' => 'nullable|string|max:255',
            '*.cpf' => 'nullable|string|max:14',
            '*.data_nascimento' => 'nullable|date',
            '*.acesso' => 'nullable|in:aluno,professor,coordenador,direcao,secretaria',
            '*.email_pessoal' => 'nullable|email',
            '*.contato' => 'nullable|string',
            '*.telefone' => 'nullable|string',
        ];
    }

    public function onFailure(Failure ...$failures): void
    {
        $messages = [];
        foreach ($failures as $failure) {
            $messages[] = "Linha {$failure->row()}: " . implode(', ', $failure->errors());
        }
        throw new \Exception(implode("\n", $messages));
    }

    private function validarDados($row): void
    {
        $camposObrigatorios = ['nome', 'cpf', 'data_nascimento', 'acesso', 'email_pessoal'];
        foreach ($camposObrigatorios as $campo) {
            if (! isset($row[$campo]) || trim((string) $row[$campo]) === '') {
                throw new \Exception("Campo obrigatório '{$campo}' está vazio.");
            }
        }

        $telefoneBruto = $row['telefone'] ?? ($row['contato'] ?? '');
        $contato = $this->limparNumero($telefoneBruto);

        if (strlen($contato) < 8 || strlen($contato) > 12) {
            throw new \Exception('Telefone/contato inválido: informe entre 8 e 12 dígitos.');
        }

        if ($row['acesso'] === 'admin') {
            throw new \Exception('Não é permitido criar usuários admin via planilha.');
        }

        $cpfLimpo = $this->limparNumero($row['cpf']);
        if (PreCadastro::where('cpf', $cpfLimpo)->exists()) {
            throw new \Exception('CPF já cadastrado.');
        }

        if (PreCadastro::where('email_pessoal', trim((string) $row['email_pessoal']))->exists()) {
            throw new \Exception('E-mail pessoal já cadastrado.');
        }
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}