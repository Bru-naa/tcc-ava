<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserImportController; 
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');
/* 
Route::fallback(function () {
    return redirect('/');
}); */


Route::post('/contato/enviar', [ContatoController::class, 'enviar'])->name('contato.enviar');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */


// Rotas da Secretaria
Route::middleware(['auth', 'verified', 'role:secretaria']) 
    ->prefix('secretaria')
    ->name('secretaria.')
    ->group(function () {
        Route::get('/home', function () {
            return view('perfis.secretaria.sec-home');
        })->name('home');

        Route::post('/importar-usuarios', [UserImportController::class, 'import'])
            ->name('users.import');
            
    });

// Rotas para Admin
Route::middleware(['auth', 'verified', 'role:admin']) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('perfis.admin.dashboard');
        })->name('admin.dashboard');
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
});


Route::middleware(['auth'])->group(function () {
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
                [],
            ),
        )
        ->name('two-factor.show');
});