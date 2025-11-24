<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusAvaliacao;
use App\Models\User;

class AvaliacaoController extends Controller
{
    public function gerenciarStatus(Request $request)
    {
        if (auth()->user()->role === 'professor') {
            abort(403, 'Acesso negado para professores');
        }
    
        $acao = $request->input('acao');
        $dataAbertura = $request->input('data_abertura');
        $dataFechamento = $request->input('data_fechamento');

        if ($acao === 'abrir') {
            return $this->abrirAvaliacoes($dataAbertura, $dataFechamento);
        } elseif ($acao === 'concluir') {
            return $this->concluirAvaliacoes();
        }

        return back()->with('error', 'Ação inválida');
    }

    private function abrirAvaliacoes($dataAbertura, $dataFechamento)
    {
        // Validações
        if (!$dataAbertura || !$dataFechamento) {
            return back()->with('error', 'Datas de abertura e fechamento são obrigatórias');
        }

        $hoje = now()->format('Y-m-d');
        
        if ($dataAbertura < $hoje) {
            return back()->with('error', 'Data de abertura não pode ser no passado');
        }
        
        if ($dataFechamento <= $dataAbertura) {
            return back()->with('error', 'Data de fechamento deve ser posterior à data de abertura');
        }

        // Verifica se já existe um registro
        $status = StatusAvaliacao::first();

        if ($status && $status->aberta) {
            return back()->with('error', 'Já existe uma avaliação em andamento');
        }

        // Cria ou atualiza o registro
        StatusAvaliacao::updateOrCreate(
            ['id' => $status ? $status->id : null],
            [
                'aberta' => true,
                'aberto_por' => auth()->user()->name,
                'fechado_por' => null,
                'data_abertura' => $dataAbertura,
                'data_fechamento' => $dataFechamento,
                'observacoes' => 'Aberto manualmente por ' . auth()->user()->name
            ]
        );

        return back()->with('success', 'Avaliações abertas com sucesso!');
    }

    private function concluirAvaliacoes()
    {
        $status = StatusAvaliacao::first();

        if (!$status || !$status->aberta) {
            return back()->with('error', 'Não há avaliação em andamento para concluir');
        }

        $status->update([
            'aberta' => false,
            'fechado_por' => auth()->user()->name,
            'observacoes' => 'Concluído manualmente por ' . auth()->user()->name
        ]);

        return back()->with('success', 'Avaliações concluídas com sucesso!');
    }

    public function verificarVencimento()
    {
        $status = StatusAvaliacao::where('aberta', true)->first();

        if ($status && $status->data_fechamento < now()) {
            $status->update([
                'aberta' => false,
                'fechado_por' => null,
                'observacoes' => 'Concluído automaticamente por tempo esgotado'
            ]);
        }
    }
}