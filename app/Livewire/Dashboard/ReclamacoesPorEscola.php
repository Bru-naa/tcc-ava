<?php

namespace App\Livewire\Dashboard;

use App\Models\Escola;
use App\Models\Reclamacao;
use Livewire\Component;

class ReclamacoesPorEscola extends Component
{
    public $selectedEscola = null;
    public $escolas = [];
    public int $total = 0;
    public int $pendentes = 0;
    public int $resolvidas = 0;
    public bool $isLoading = false;

    public function mount(): void
    {
        $this->loadEscolas();
    }

    public function loadEscolas(): void
    {
        try {
            $this->escolas = Escola::select('id', 'esc_nome')
                ->orderBy('esc_nome')
                ->get();
        } catch (\Exception $e) {
            $this->escolas = [];
        }
    }

    public function updatedSelectedEscola($value): void
    {
        if ($value) {
            $this->loadDadosEscola((int) $value);
        } else {
            $this->resetDados();
        }
    }

    private function loadDadosEscola(int $escolaId): void
    {
        $this->isLoading = true;

        try {
            $resumo = Reclamacao::where('escola_id', $escolaId)
                ->selectRaw("
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'pendente' THEN 1 ELSE 0 END) as pendentes,
                    SUM(CASE WHEN status = 'resolvida' THEN 1 ELSE 0 END) as resolvidas
                ")
                ->first();

            $this->total = (int) ($resumo?->total ?? 0);
            $this->pendentes = (int) ($resumo?->pendentes ?? 0);
            $this->resolvidas = (int) ($resumo?->resolvidas ?? 0);
        } catch (\Exception $e) {
            $this->resetDados();
        }

        $this->isLoading = false;
    }

    private function resetDados(): void
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