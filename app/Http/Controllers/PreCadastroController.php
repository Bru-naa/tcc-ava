<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreRegistro;
use App\Models\Role;
use App\Models\Escola;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PreCadastroController extends Controller
{
    public function create($userId = null)
    {
        $roles = Role::where('acesso', '!=', 'admin')->get();
        $escolas = in_array(Auth::user()->role->acesso, ['secretaria', 'direcao'])
                    ? collect([Auth::user()->escola])
                    : Escola::all();

        $prefill = null;
        if ($userId) {
            $prefill = User::findOrFail($userId);
        }

        return view('flux.precadastro-form', compact('roles', 'escolas', 'prefill'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'email_pessoal' => 'required|email|unique:pre_registros,email_pessoal',
            'cpf' => 'required|string|size:11|unique:pre_registros,cpf',
            'telefone' => 'required|string|min:10|max:15',
            'data_nascimento' => 'required|date|before:today',
            'role_id' => 'required|integer|exists:roles,id',
            'escola_id' => 'required|integer|exists:escolas,id',
        ]);

        $cpf = preg_replace('/\D/', '', $request->cpf);
        $telefone = preg_replace('/\D/', '', $request->telefone);

        $emailInstitucional = $this->gerarEmailInstitucional($request->nome, $request->role_id);

        PreRegistro::create([
            'nome' => $request->nome,
            'telefone' => $telefone,
            'data_nascimento' => $request->data_nascimento,
            'cpf' => $cpf,
            'email_pessoal' => $request->email_pessoal,
            'email_institucional' => $emailInstitucional,
            'escola_id' => $request->escola_id,
            'role_id' => $request->role_id,
            'status' => 'pendente',
            'criado_por' => Auth::user()->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('pre-cadastro.create')->with('success', 'Pré-cadastro criado com sucesso!');
    }

    private function gerarEmailInstitucional($nome, $role_id)
    {
        $role = Role::findOrFail($role_id);
        $acesso = $role->acesso ?? 'escola';

        $domains = [
            'professor' => '@professor.gov.br',
            'coordenador' => '@coordenacao.gov.br',
            'direcao' => '@direcao.gov.br',
            'secretaria' => '@secretaria.gov.br',
            'admin' => '@administracao.gov.br',
            'escola' => '@escola.gov.br'
        ];

        $domain = $domains[$acesso] ?? '@escola.gov.br';
        $username = Str::slug($this->extrairPrimeiroUltimoNome($nome), '.');
        $finalEmail = $username . $domain;

        $counter = 1;
        while (PreRegistro::where('email_institucional', $finalEmail)->exists()) {
            $finalEmail = $username . $counter . $domain;
            $counter++;
        }

        return $finalEmail;
    }

    private function extrairPrimeiroUltimoNome($nomeCompleto)
    {
        $nomes = explode(' ', trim($nomeCompleto));
        return count($nomes) === 1 ? $nomes[0] : $nomes[0] . '.' . end($nomes);
    }
}
