<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreCadastro; 
use App\Models\Role;
use App\Models\Escola;
use App\Models\User; 
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
            'cpf' => 'required|string|size:14|unique:pre_registros,cpf',
            'telefone' => 'required|string|min:10|max:15',
            'data_nascimento' => 'required|date|before:today',
            'role_id' => 'required|integer|exists:roles,id',
            'escola_id' => 'required|integer|exists:escolas,id',
        ]);

        try {
            
            $preCadastro = PreCadastro::criarComEmailInstitucional($request->all());
            
            \Log::info('Pré-cadastro criado com ID: ' . $preCadastro->id);
            
            return redirect()->route('secretaria.home')->with('success', 'Pré-cadastro criado com sucesso!');
            
        } catch (\Exception $e) {
            \Log::error('Erro ao criar pré-cadastro: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao criar pré-cadastro: ' . $e->getMessage());
        }
    }

}