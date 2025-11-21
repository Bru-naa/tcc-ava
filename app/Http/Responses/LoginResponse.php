<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    if ($user->hasRole('secretaria')) {
    return redirect()->route('secretaria.home');
}

if ($user->hasRole('coordenador')) {
    return redirect()->route('coordenacao.painel');
}

if ($user->hasRole('professor')) {
    return redirect()->route('professor.painel');
}

if ($user->hasRole('direcao')) {
    return redirect()->route('direcao.painel');
}

return redirect()->route('home');

}
