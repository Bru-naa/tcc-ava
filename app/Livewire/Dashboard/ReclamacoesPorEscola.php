<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Escola;
use App\Models\Reclamacao;

class ReclamacoesPorEscola extends Component
{
    public $selectedEscola = null;
    public $escolas = [];
    public $total = 0;
    public $pendentes = 0;
    public $resolvidas = 0;
    public $isLoading = false;

    public function mount()
    {
        $this->loadEscolas();
    }

    public function loadEscolas()
    {
        try {
            $this->escolas = Escola::select('id', 'esc_nome')
                ->orderBy('esc_nome')
                ->get();
        } catch (\Exception $e) {
            $this->escolas = [];
        }
    }

    public function updatedSelectedEscola($value)
    {
        if ($value) {
            $this->loadDadosEscola($value);
        } else {
            $this->resetDados();
        }
    }

    private function loadDadosEscola($escolaId)
    {
        $this->isLoading = true;
        
        try {
            $this->total = Reclamacao::where('escola_id', $escolaId)->count();
            $this->pendentes = Reclamacao::where('escola_id', $escolaId)
                ->where('status', 'pendente')
                ->count();
            $this->resolvidas = Reclamacao::where('escola_id', $escolaId)
                ->where('status', 'resolvida')
                ->count();
        } catch (\Exception $e) {
            $this->resetDados();
        }
        
        $this->isLoading = false;
    }

    private function resetDados()
    {
        $this->total = 0;
        $this->pendentes = 0;
        $this->resolvidas = 0;
    }

    public function render()
    {
        return view('livewire.dashboard.reclamacoes-por-escola');
    }
}