<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PreCadastro;
use livewire\WithFileUploads;
use Maatwebsite\Excel\Facades;

class PreRegistroTable extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $preRegistros = PreRegistro::with(['role', 'escola'])
            ->when($this->search, function ($query) {
                $query->where('nome', 'like', '%' . $this->search . '%')
                      ->orWhere('email_institucional', 'like', '%' . $this->search . '%')
                      ->orWhere('email_pessoal', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pre-registro-table', compact('preRegistros'));
    }

    public function delete($id)
    {
        $preRegistro = PreRegistro::findOrFail($id);
        $preRegistro->delete();
        
        session()->flash('message', 'Pré-registro deletado com sucesso!');
    }
}