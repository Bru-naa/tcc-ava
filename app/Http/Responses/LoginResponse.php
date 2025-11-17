<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->hasRole('secretaria')) {
            return redirect()->route('secretaria.home');
        }

        if ($user->hasRole('coordenacao')) {
            return redirect()->route('coordenacao.home');
        }
       
         if ($user->hasRole('professor')) {
            return redirect()->route('professor.home');
        }
        return redirect()->route('home');
    }
}
