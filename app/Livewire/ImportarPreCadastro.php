<?php

namespace App\Livewire;

use App\Imports\UsersImport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportarPreCadastro extends Component
{
    use WithFileUploads;

    public bool $permitirUpload = false;
    public $arquivo;
    public array $previewLinhas = [];
    public int $totalLinhas = 0;

    public function habilitarUpload(): void
    {
        $this->permitirUpload = true;
    }

    public function desabilitarUpload(): void
    {
        $this->permitirUpload = false;
    }

    private function obterEscolaId(): int
    {
        return (int) (Auth::user()?->escola_id ?? 1);
    }

    public function updatedArquivo(): void
    {
        $this->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $data = Excel::toArray(new UsersImport($this->obterEscolaId()), $this->arquivo);

            if (! empty($data[0])) {
                $this->previewLinhas = array_slice($data[0], 0, 5);
                $this->totalLinhas = count($data[0]);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao ler arquivo: ' . $e->getMessage());
        }
    }

    public function importar(): void
    {
        $this->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new UsersImport($this->obterEscolaId()), $this->arquivo);

            session()->flash('success', 'Importação realizada com sucesso!');
            $this->reset(['arquivo', 'previewLinhas', 'totalLinhas']);
        } catch (\Exception $e) {
            session()->flash('error', 'Erro na importação: ' . $e->getMessage());
        }
    }

    public function cancelar(): void
    {
        $this->reset(['arquivo', 'previewLinhas', 'totalLinhas']);
    }

    public function render()
    {
        return view('livewire.importar-pre-cadastro');
    }
}