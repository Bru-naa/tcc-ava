<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        //Se não estiver logado com o perfil adequado, redireciona para o login
        if (! $user){
            redirect()->route('login')->send();
        }
         
        if (! in_array($user->role->slug, $roles)){
            abort(403, 'Acesso negado, utiliador sem permissão.');
        }
        return $next($request);
    }
}
