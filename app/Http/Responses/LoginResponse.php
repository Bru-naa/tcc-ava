<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user()?->loadMissing('role');
        $acesso = $user?->role?->acesso;

        return match ($acesso) {
            'secretaria' => redirect()->route('secretaria.home'),
            'direcao' => redirect()->route('direcao.painel'),
            'coordenador' => redirect()->route('coordenacao.painel'),
            'professor' => redirect()->route('professor.painel'),
            'aluno' => Route::has('aluno.painel')
                ? redirect()->route('aluno.painel')
                : redirect()->route('landing'),
            'admin' => Route::has('admin.dashboard')
                ? redirect()->route('admin.dashboard')
                : redirect()->route('landing'),
            default => redirect()->route('landing'),
        };
    }
}