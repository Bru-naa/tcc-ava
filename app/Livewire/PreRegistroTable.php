<?php

namespace App\Livewire;

use App\Models\PreCadastro;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PreRegistroTable extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $escolaId = Auth::user()?->escola_id;

        $preRegistros = PreCadastro::with(['role', 'escola'])
            ->when($escolaId, fn (Builder $query, int $id) => $query->daEscola($id))
            ->when($this->search, function (Builder $query) {
                $termo = '%' . $this->search . '%';
                $query->where(function (Builder $q) use ($termo) {
                    $q->where('nome', 'like', $termo)
                        ->orWhere('email_institucional', 'like', $termo)
                        ->orWhere('email_pessoal', 'like', $termo);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pre-registro-table', compact('preRegistros'));
    }

    public function delete(int $id): void
    {
        $escolaId = Auth::user()?->escola_id;

        $preRegistro = PreCadastro::when($escolaId, fn (Builder $q, int $eId) => $q->daEscola($eId))
            ->findOrFail($id);

        $preRegistro->delete();

        session()->flash('message', 'Pré-cadastro excluído com sucesso!');
    }
}