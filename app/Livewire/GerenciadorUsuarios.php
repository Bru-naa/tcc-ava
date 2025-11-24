<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;

class GerenciadorUsuarios extends Component
{
    public $alun_nome = '';
    public $alun_email = '';
    public $alun_data_nascimento = '';
    public $alun_telefone = '';
    public $alun_cpf = '';
    public $alun_endereco = '';
    public $alun_sexo = '';

    public $mensagem = '';
    public $tipoMensagem = 'success';
    public $carregando = false;

    public function mount()
    {
        $acesso = Auth::user()->role->acesso;
        if (!in_array($acesso, ['admin', 'secretaria', 'direcao'])) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    public function insertAlunos()
    {
        try {
            $this->carregando = true;

            $this->validate([
                'alun_nome'             => 'required|string|max:50',
                'alun_email'            => 'required|email|unique:alunos,alun_email',
                'alun_data_nascimento'  => 'required|date|before_or_equal:' . now()->subYears(12)->format('Y-m-d'),
                'alun_telefone'         => 'required|string|max:15',
                'alun_cpf'              => 'required|string|max:14|unique:alunos,alun_cpf',
                'alun_endereco'         => 'required|string',
                'alun_sexo'             => 'required|in:masculino,feminino,outro',
            ], [
                'alun_email.unique' => 'Este email já está cadastrado.',
                'alun_cpf.unique' => 'Este CPF já está cadastrado.',
                'alun_data_nascimento.before_or_equal' => 'O aluno deve ter pelo menos 12 anos.',
            ]);

            Aluno::create([
                'alun_nome'            => $this->alun_nome,
                'alun_email'           => $this->alun_email,
                'alun_data_nascimento' => $this->alun_data_nascimento,
                'alun_telefone'        => $this->alun_telefone,
                'alun_cpf'             => $this->alun_cpf,
                'alun_endereco'        => $this->alun_endereco,
                'alun_sexo'            => $this->alun_sexo,
                'status'               => 'ativo',
            ]);

            $this->mensagem = 'Aluno cadastrado com sucesso!';
            $this->tipoMensagem = 'success';

            // Limpa o formulário
            $this->reset();

        } catch (\Exception $e) {
            $this->mensagem = 'Erro ao cadastrar aluno: ' . $e->getMessage();
            $this->tipoMensagem = 'error';
        } finally {
            $this->carregando = false;
        }
    }

    public function render()
    {
        return view('livewire.gerenciador-usuarios');
    }
}