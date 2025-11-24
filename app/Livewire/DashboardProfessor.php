<?php
// app/Livewire/CursoEditModal.php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate; 

class CursoEditModal extends Component
{
    public $isOpen = false;
    public $cursoId = null;
    
    #[Validate('required|string|max:255')]
    public $nome = '';
    
    #[Validate('required|string')]
    public $descricao = '';

    public function abrirModal($cursoId = null)
    {
        $this->cursoId = $cursoId;
        $this->isOpen = true;
        
        // Se está editando, carrega os dados
        if ($cursoId) {
            $this->carregarCurso($cursoId);
        }
    }

    public function fecharModal()
    {
        $this->reset();
        $this->isOpen = false;
    }

    public function salvar()
    {
        $this->validate();
        
        // Lógica para salvar/atualizar curso
        if ($this->cursoId) {
            // Atualizar curso existente
            session()->flash('message', 'Curso atualizado com sucesso!');
        } else {
            // Criar novo curso
            session()->flash('message', 'Curso criado com sucesso!');
        }
        
        $this->fecharModal();
        $this->dispatch('curso-atualizado'); // Notifica outros componentes
    }

    private function carregarCurso($cursoId)
    {
       
        $cursos = [
            1 => ['nome' => 'Matemática', 'descricao' => 'Curso de matemática básica'],
            2 => ['nome' => 'Português', 'descricao' => 'Curso de português']
        ];
        
        if (isset($cursos[$cursoId])) {
            $this->nome = $cursos[$cursoId]['nome'];
            $this->descricao = $cursos[$cursoId]['descricao'];
        }
    }

    public function render()
    {
        return view('livewire.curso-edit-modal');
    }
}