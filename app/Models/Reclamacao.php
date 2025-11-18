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

    public function mount()
    {
        $this->escolas = Escola::orderBy('esc_nome')->get();
    }

    public function updatedSelectedEscola($id)
    {
        if (!$id) {
            $this->total = 0;
            $this->pendentes = 0;
            $this->resolvidas = 0;
            return;
        }

        $this->total = Reclamacao::where('escola_id', $id)->count();
        $this->pendentes = Reclamacao::where('escola_id', $id)->where('status', 'pendente')->count();
        $this->resolvidas = Reclamacao::where('escola_id', $id)->where('status', 'resolvida')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.reclamacoes-por-escola');
    }
}
