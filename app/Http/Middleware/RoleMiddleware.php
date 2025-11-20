<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Verifica se o usuário tem role
        if (! $user->role) {
            abort(403, 'Usuário sem perfil definido.');
        }

        // Verifica se o acesso está na lista permitida
        if (! in_array($user->role->acesso, $roles)) {
           
            // log
            \Log::warning("Tentativa de acesso não autorizado", [
                'user_id' => $user->id,
                'user_role' => $user->role->acesso,
                'required_roles' => $roles,
                'route' => $request->route()->getName()
            ]);
            
            abort(403, 'Acesso negado. Permissão necessária: ' . implode(', ', $roles));
        }

        return $next($request);
    }
}