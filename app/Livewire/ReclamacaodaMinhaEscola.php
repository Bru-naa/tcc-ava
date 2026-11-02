<?php

namespace App\Livewire;

use App\Models\Reclamacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReclamacaodaMinhaEscola extends Component
{
    public int $total = 0;
    public int $pendentes = 0;
    public int $resolvidas = 0;
    public bool $isLoading = true;
    public string $nomeEscola = '';

    public function mount(): void
    {
        $this->carregarDados();
    }

    public function carregarDados(): void
    {
        $user = Auth::user();

        if (! $user?->escola_id) {
            $this->isLoading = false;
            return;
        }

        $this->nomeEscola = $user->escola?->esc_nome ?? 'Minha Escola';

        $resumo = Reclamacao::where('escola_id', $user->escola_id)
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pendente' THEN 1 ELSE 0 END) as pendentes,
                SUM(CASE WHEN status = 'resolvida' THEN 1 ELSE 0 END) as resolvidas
            ")
            ->first();

        $this->total = (int) ($resumo?->total ?? 0);
        $this->pendentes = (int) ($resumo?->pendentes ?? 0);
        $this->resolvidas = (int) ($resumo?->resolvidas ?? 0);
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.reclamacaoda-minha-escola');
    }
}