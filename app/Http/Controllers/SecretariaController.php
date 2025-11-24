<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Curso;
use App\Models\PreCadastro;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function home()
    {
        $roles = Role::all();
        $escolas = Escola::where('ativo', true)->get();
          $cursos = Curso::where('ativo', true)->get(); 
        
        return view('perfis.secretaria.sec-home', compact('roles', 'escolas','cursos'));
    }
}