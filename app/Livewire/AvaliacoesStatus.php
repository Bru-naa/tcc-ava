<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StatusAvaliacao;
use Illuminate\Support\Facades\Auth;

class AvaliacoesStatus extends Component
{
    public $aberta = false;
    public $ano;
    public $semestre;
    public $periodo;
    public $observacoes;
    
    public $editId;
    public $editAberta;
    public $editAno;
    public $editSemestre;
    public $editPeriodo;
    public $editObservacoes;

    
    public $anos = [];
    public $semestres = [
        '1' => '1º Semestre',
        '2' => '2º Semestre'
    ];

    public function mount()
    {
        //  2020 até 2030
        $this->anos = array_combine(
            range(date('Y'), 2030),
            range(date('Y'), 2030)
        );
        
        // Definir ano atual como padrão
        $this->ano = date('Y');
        $this->semestre = '1';
    }

    protected function rules()
    {
        return [
            'ano' => 'required|integer|min:2020|max:2030',
            'semestre' => 'required|in:1,2',
            'periodo' => 'required|string|unique:status_avaliacoes,periodo',
            'observacoes' => 'nullable|string|max:255',
        ];
    }

    protected $messages = [
        'ano.required' => 'O ano é obrigatório.',
        'semestre.required' => 'O semestre é obrigatório.',
        'periodo.required' => 'O período é obrigatório.',
        'periodo.unique' => 'Este período já existe.',
    ];

    public function updatedAno()
    {
        $this->updatePeriodo();
    }

    public function updatedSemestre()
    {
        $this->updatePeriodo();
    }

    protected function updatePeriodo()
    {
        if ($this->ano && $this->semestre) {
            $this->periodo = $this->ano . '/' . $this->semestre;
        }
    }

    public function render()
    {
        $statusAvaliacoes = StatusAvaliacao::latest()->get();
        return view('livewire.status-avaliacoes', compact('statusAvaliacoes'));
    }

    public function abrirAvaliacao()
    {
        //  o período antes da validação
        $this->updatePeriodo();
        
        $this->validate();

        StatusAvaliacao::create([
            'aberta' => true,
            'aberto_por' => Auth::user()->name,
            'data_abertura' => now(),
            'periodo' => $this->periodo,
            'observacoes' => $this->observacoes,
        ]);

        $this->reset(['ano', 'semestre', 'periodo', 'observacoes']);
        $this->ano = date('Y');
        $this->semestre = '1';
        
        session()->flash('message', 'Avaliação aberta com sucesso!');
    }

    public function fecharAvaliacao($id)
    {
        $avaliacao = StatusAvaliacao::findOrFail($id);
        
        $avaliacao->update([
            'aberta' => false,
            'fechado_por' => Auth::user()->name,
            'data_fechamento' => now(),
        ]);

        session()->flash('message', 'Avaliação fechada com sucesso!');
    }

    public function reabrirAvaliacao($id)
    {
        $avaliacao = StatusAvaliacao::findOrFail($id);
        
        $avaliacao->update([
            'aberta' => true,
            'aberto_por' => Auth::user()->name,
            'data_abertura' => now(),
            'fechado_por' => null,
            'data_fechamento' => null,
        ]);

        session()->flash('message', 'Avaliação reaberta com sucesso!');
    }

    public function edit($id)
    {
        $avaliacao = StatusAvaliacao::findOrFail($id);
        
        //  (formato: 2025/1)
        $periodoParts = explode('/', $avaliacao->periodo);
        
        $this->editId = $avaliacao->id;
        $this->editAberta = $avaliacao->aberta;
        $this->editAno = $periodoParts[0] ?? date('Y');
        $this->editSemestre = $periodoParts[1] ?? '1';
        $this->editPeriodo = $avaliacao->periodo;
        $this->editObservacoes = $avaliacao->observacoes;
    }

    public function updateEditPeriodo()
    {
        if ($this->editAno && $this->editSemestre) {
            $this->editPeriodo = $this->editAno . '/' . $this->editSemestre;
        }
    }

    public function updatedEditAno()
    {
        $this->updateEditPeriodo();
    }

    public function updatedEditSemestre()
    {
        $this->updateEditPeriodo();
    }

    public function update()
    {
        $this->updateEditPeriodo();
        
        $this->validate([
            'editAno' => 'required|integer|min:2020|max:2030',
            'editSemestre' => 'required|in:1,2',
            'editPeriodo' => 'required|string|unique:status_avaliacoes,periodo,' . $this->editId,
            'editObservacoes' => 'nullable|string|max:255',
        ]);

        $avaliacao = StatusAvaliacao::findOrFail($this->editId);
        
        $avaliacao->update([
            'periodo' => $this->editPeriodo,
            'observacoes' => $this->editObservacoes,
        ]);

        $this->cancelEdit();
        session()->flash('message', 'Avaliação atualizada com sucesso!');
    }

    public function cancelEdit()
    {
        $this->reset(['editId', 'editAberta', 'editAno', 'editSemestre', 'editPeriodo', 'editObservacoes']);
    }

    public function delete($id)
    {
        StatusAvaliacao::findOrFail($id)->delete();
        session()->flash('message', 'Avaliação excluída com sucesso!');
    }
}