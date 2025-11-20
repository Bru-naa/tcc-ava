<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportUsers extends Component
{
    use WithFileUploads;

    public $arquivo;
    public $previewLinhas = [];
    public $totalLinhas = 0;

    public function updatedArquivo()
    {
        $this->reset(['previewLinhas', 'totalLinhas']);

        if (!$this->arquivo) {
            return;
        }

        // Valida
        $this->validate([
            'arquivo' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Carrega preview das 10 primeiras linhas
        $dados = Excel::toArray([], $this->arquivo);

        if (isset($dados[0])) {
            $this->previewLinhas = array_slice($dados[0], 0, 10);
            $this->totalLinhas = count($dados[0]);
        }
    }

    public function cancelar()
    {
        $this->reset(['arquivo', 'previewLinhas', 'totalLinhas']);
    }

    public function importar()
    {
        $this->validate([
            'arquivo' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Aqui você coloca a lógica real do import:
        // Excel::import(new UsuariosImport, $this->arquivo);

        // Apenas para teste:
        session()->flash('success', 'Importação concluída!');

        $this->cancelar();
    }

    public function render()
    {
        return view('livewire.import-users');
    }
}
