<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserImportController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreCadastroController;
use App\Models\Role;
use App\Models\Escola;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::post('/contato/enviar', [ContatoController::class, 'enviar'])->name('contato.enviar');

// Rotas da Secretaria
Route::middleware(['auth', 'verified', 'role:secretaria']) 
    ->prefix('secretaria')
    ->name('secretaria.')
    ->group(function () {
        Route::get('/home', function () {
            $roles = Role::where('acesso', '!=', 'admin')->get();
            $escolas = in_array(Auth::user()->role->acesso, ['secretaria', 'direcao'])
                        ? collect([Auth::user()->escola])
                        : Escola::all();

            return view('perfis.secretaria.sec-home', compact('roles', 'escolas'));
        })->name('home');
       
        Route::get('/pre-cadastro', [PreCadastroController::class, 'create'])->name('pre-cadastro.create');
        Route::post('/pre-cadastro', [PreCadastroController::class, 'store'])->name('pre-cadastro.store');

        /* Route::post('/importar-usuarios', [UserImportController::class, 'import'])
            ->name('usuarios.import'); */
    });

// Rotas para Admin
Route::middleware(['auth', 'verified', 'role:admin']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('perfis.admin.dashboard');
        })->name('dashboard');
    });

// Rotas para Professor  
Route::middleware(['auth', 'verified', 'role:professor']) 
    ->prefix('professor')
    ->name('professor.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.professor.painel');
        })->name('painel');
    });

// Rotas para Coordenação
Route::middleware(['auth', 'verified', 'role:coordenador']) 
    ->prefix('coordenacao')
    ->name('coordenacao.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.coordenacao.painel');
        })->name('painel');
    });

// Rotas para Direção
Route::middleware(['auth', 'verified', 'role:direcao']) 
    ->prefix('direcao')
    ->name('direcao.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.direcao.painel');
        })->name('painel');
    });

// CONFIGURAÇÕES
Route::middleware(['auth'])->group(function () {
    Route::get('settings', function() {
        return redirect()->route('profile.edit');
    })->name('settings');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                []
            )
        )
        ->name('two-factor.show');
});
