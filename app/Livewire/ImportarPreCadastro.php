<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportarPreCadastro extends Component
{
    use WithFileUploads;

     public $permitirUpload = false; // desabilitado

    // Método para habilitar 
    public function habilitarUpload()
    {
        $this->permitirUpload = true;
    }

    // Método para desabilitar 
    public function desabilitarUpload()
    {
        $this->permitirUpload = false;
    }
    
    public $arquivo;
    public $previewLinhas = [];
    public $totalLinhas = 0;

    public function updatedArquivo()
    {

        
        $this->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);

        try {
            // Fazer preview do arquivo
            $data = Excel::toArray(new UsersImport(1), $this->arquivo); // escola_id 1 temporário
            
            if (!empty($data[0])) {
                $this->previewLinhas = array_slice($data[0], 0, 5); // Primeiras 5 linhas
                $this->totalLinhas = count($data[0]);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao ler arquivo: ' . $e->getMessage());
        }
    }

    public function importar()
    {
        $this->validate([
            'arquivo' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);

        try {
            // Importar para pre_registro
            Excel::import(new UsersImport(1), $this->arquivo); // escola_id 1 temporário
            
            session()->flash('success', 'Importação realizada com sucesso!');
            $this->reset(['arquivo', 'previewLinhas', 'totalLinhas']);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erro na importação: ' . $e->getMessage());
        }
    }

    public function cancelar()
    {
        $this->reset(['arquivo', 'previewLinhas', 'totalLinhas']);
    }

    public function render()
    {
        return view('livewire.importar-pre-cadastro');
    }
}