<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Reclamacao;
use Illuminate\Support\Facades\Auth;

class ReclamacaoDaMinhaEscola extends Component
{
    public $total = 0;
    public $pendentes = 0;
    public $resolvidas = 0;
    public $isLoading = true;
    public $nomeEscola = '';

    public function mount()
    {
        $this->carregarDados();
    }

    public function carregarDados()
    {
        $user = Auth::user();
        
        if (!$user->escola_id) {
            $this->isLoading = false;
            return;
        }

        // Carrega o nome da escola
        $this->nomeEscola = $user->escola->esc_nome ?? 'Minha Escola';

        // Carrega os dados das reclamações
        $this->total = Reclamacao::where('escola_id', $user->escola_id)->count();
        $this->pendentes = Reclamacao::where('escola_id', $user->escola_id)
                                    ->where('status', 'pendente')
                                    ->count();
        $this->resolvidas = Reclamacao::where('escola_id', $user->escola_id)
                                     ->where('status', 'resolvida')
                                     ->count();
        
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.reclamacaoda-minha-escola');
    }
}