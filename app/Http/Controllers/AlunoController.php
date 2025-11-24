<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
   public function store(Request $request)
{
    // Validação
    $validated = $request->validate([
        'alun_nome'             => 'required|string|max:50',
        'alun_email'            => 'required|email|unique:alunos,alun_email',
        'alun_data_nascimento'  => 'required|date|before_or_equal:' . now()->subYears(12)->format('Y-m-d'),
        'alun_telefone'         => 'required|string|max:15',
        'alun_cpf'              => 'required|string|max:14|unique:alunos,alun_cpf',
        'alun_endereco'         => 'required|string',
        'alun_sexo'             => 'required|in:masculino,feminino,outro',
        'curso_id'              => 'required|exists:cursos,id',
    ]);

    // Cria o aluno
    $aluno = Aluno::create([
        'alun_nome'            => $validated['alun_nome'],
        'alun_email'           => $validated['alun_email'],
        'alun_data_nascimento' => $validated['alun_data_nascimento'],
        'alun_telefone'        => $validated['alun_telefone'],
        'alun_cpf'             => $validated['alun_cpf'],
        'alun_endereco'        => $validated['alun_endereco'],
        'alun_sexo'            => $validated['alun_sexo'],
        'status'               => 'ativo',
    ]);

    // Pega o curso
    $curso = Curso::findOrFail($validated['curso_id']);

    // Gera a matrícula automaticamente via Model
    $codigoMatricula = $curso->gerarMatriculaUnica();

    // Cria a matrícula
    Matricula::create([
        'aluno_id'         => $aluno->id,
        'curso_id'         => $curso->id,
        'codigo_matricula' => $codigoMatricula,
        'data_matricula'   => now(),
        'status'           => 'ativa'
    ]);

    return redirect()->back()
        ->with('success', 'Aluno cadastrado com sucesso! Matrícula: ' . $codigoMatricula);
}

}