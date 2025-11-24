<?php

namespace App\Livewire;

use App\Models\Curso;
use App\Models\Escola;
use Livewire\Component;

class CursoEditModal extends Component
{
    public $show = false;
    public $cursoId;
    public $curso;
    public $escolas;

    protected $listeners = ['openEditModal' => 'open'];

    public function mount()
    {
        $this->escolas = Escola::where('ativo', true)->get();
    }

    public function open($cursoId)
    {
        $this->cursoId = $cursoId;
        $this->curso = Curso::find($cursoId);
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
        $this->curso = null;
        $this->cursoId = null;
    }

    public function update()
    {
        $this->validate([
            'curso.nome_curso' => 'required|string|max:100',
            'curso.sigla' => 'required|string|max:4',
            'curso.descricao_curso' => 'nullable|string',
            'curso.duracao_curso' => 'required|integer|min:1|max:120',
            'curso.nivel_curso' => 'required|string',
            'curso.area_curso' => 'required|string|max:50',
            'curso.ativo' => 'boolean',
        ]);

        if ($this->curso) {
            $this->curso->save();
            $this->close();
            $this->dispatch('curso-updated');
        }
    }

    public function render()
    {
        return view('livewire.curso-edit-modal');
    }
}