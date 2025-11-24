<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Escola;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_curso' => 'required|string|max:100',
            'sigla' => [
                'required',
                'string',
                'min:3',
                'max:4',
                'regex:/^[A-Z0-9]{3,4}$/',
                'unique:cursos,sigla'
            ],
            'descricao_curso' => 'nullable|string',
            'duracao_curso' => 'required|integer|min:1|max:120',
            'nivel_curso' => 'required|string',
            'area_curso' => 'required|string|max:50',
            'escola_id' => 'required|exists:escolas,id',
            'ativo' => 'boolean'
        ]);

        Curso::create($validated);
        
        return redirect()->route('secretaria.home')->with('success', 'Curso cadastrado com sucesso!');
    }
}