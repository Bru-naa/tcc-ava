<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;

class ReclamacaoController extends Controller
{
    // Exibir reclamações de uma escola específica
    public function index(Escola $escola)
    {
        return view('reclamacoes.index', [
            'escola' => $escola,
            'reclamacoes' => $escola->reclamacoes()->latest()->get()
        ]);
    }
}
