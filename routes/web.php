<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PreCadastroController;
use App\Http\Controllers\SecretariaController;
use App\Models\PreCadastro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::fallback(function () {
    if (! auth()->check()) {
        return redirect()->route('landing');
    }
    abort(404);
});

Route::post('/contato/enviar', [ContatoController::class, 'enviar'])->name('contato.enviar');

Route::post('/register/check-email', function (Request $request) {
    $preCadastrado = PreCadastro::where('email_institucional', $request->email)
        ->where('status', 'pendente')
        ->exists();

    return response()->json(['pre_cadastrado' => $preCadastrado]);
})->middleware('throttle:10,1')->name('register.check-email');

Route::post('/avaliacoes/gerenciar', [AvaliacaoController::class, 'gerenciarStatus'])
    ->name('avaliacoes.gerenciar')
    ->middleware('auth');

Route::middleware(['auth', 'verified', 'role:secretaria'])
    ->prefix('secretaria')
    ->name('secretaria.')
    ->group(function () {
        Route::get('/home', [SecretariaController::class, 'home'])->name('home');
        Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
        Route::post('/pre-cadastro', [PreCadastroController::class, 'store'])->name('pre-cadastro.store');
        Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
    });

Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('perfis.admin.admin-home');
        })->name('dashboard');
    });

Route::middleware(['auth', 'verified', 'role:professor'])
    ->prefix('professor')
    ->name('professor.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.professor.professor-home');
        })->name('painel');
    });

Route::middleware(['auth', 'verified', 'role:coordenador'])
    ->prefix('coordenacao')
    ->name('coordenacao.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.coordenador.coordenador-home');
        })->name('painel');
    });

Route::middleware(['auth', 'verified', 'role:direcao'])
    ->prefix('direcao')
    ->name('direcao.')
    ->group(function () {
        Route::get('/painel', function () {
            return view('perfis.direcao.direcao-home');
        })->name('painel');
    });

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile')->name('settings');

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