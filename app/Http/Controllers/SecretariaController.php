<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Escola;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class SecretariaController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $roles = Role::where('acesso', '!=', 'admin')->get();

        $escolas = in_array($user?->role?->acesso, ['secretaria', 'direcao'], true)
            ? collect([$user->escola])
            : Escola::where('ativo', true)->get();

        $cursos = Curso::where('ativo', true)
            ->when($user?->escola_id, fn ($q, $escolaId) => $q->where('escola_id', $escolaId))
            ->get();

        return view('perfis.secretaria.sec-home', compact('roles', 'escolas', 'cursos'));
    }
}