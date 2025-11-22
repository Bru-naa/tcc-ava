<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aluno;
use App\Models\PreRegistro;
use App\Models\User;
use App\Models\Role;    
use Illuminate\Support\Facades\Auth;


class GerenciadorUsuarios extends Component
{

    public function mount(){

     $acesso = Auth::user()->role->acesso;

if (!in_array($acesso, ['admin', 'secretaria', 'direcao'])) {
    abort(403, 'Acesso não autorizado.');
}


    }
    // Campos do formulário
    public $alun_nome;
    public $alun_email;
    public $alun_data_nascimento;
    public $alun_telefone;
    public $alun_cpf;
    public $alun_endereco;
    public $alun_sexo;
    public $status = 'ativo';

    // Controle de mensagens
    public $mensagem = '';
    public $tipoMensagem = 'success';

    public $carregando = false;

    public function insertAlunos()
    {
        try {
            $this->carregando = true;

            $this->validate([
                'alun_nome'             => 'required|string',
                'alun_email'            => 'required|email',
                'alun_data_nascimento'  => 'required|date',
                'alun_telefone'         => 'required|string',
                'alun_cpf'              => 'required|string',
                'alun_endereco'         => 'required|string',
                'alun_sexo'             => 'required|in:masculino,feminino,outro',
            ]);

            Aluno::create([
                'alun_nome'            => $this->alun_nome,
                'alun_email'           => $this->alun_email,
                'alun_data_nascimento' => $this->alun_data_nascimento,
                'alun_telefone'        => $this->alun_telefone,
                'alun_cpf'             => $this->alun_cpf,
                'alun_endereco'        => $this->alun_endereco,
                'alun_sexo'            => $this->alun_sexo,
                'status'               => $this->status,
            ]);

            $this->mensagem = 'Aluno cadastrado com sucesso!';
            $this->tipoMensagem = 'success';

            // Limpa inputs
            $this->reset([
                'alun_nome',
                'alun_email',
                'alun_data_nascimento',
                'alun_telefone',
                'alun_cpf',
                'alun_endereco',
                'alun_sexo'
            ]);

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
