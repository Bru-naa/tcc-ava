<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserImportController; 
use App\Http\Controllers\UserController;
use App\Models\Role;
use App\Models\Escola;
use App\Http\Controllers\PreCadastroController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing-page');
})->name('landing');

Route::fallback(function () {
    if (!auth()->check()) {
        return redirect()->route('landing');
    }
    abort(404);
});

Route::post('/contato/enviar', [ContatoController::class, 'enviar'])->name('contato.enviar');

Route::post('/register/check-email', function (Illuminate\Http\Request $request) {
    $preCadastrado = \App\Models\PreCadastro::where('email_institucional', $request->email)->exists();
    
    return response()->json(['pre_cadastrado' => $preCadastrado]);
})->name('register.check-email');

Route::post('/avaliacoes/gerenciar', [AvaliacaoController::class, 'gerenciarStatus'])
     ->name('avaliacoes.gerenciar')
     ->middleware('auth');

Route::middleware(['auth', 'verified', 'role:secretaria']) 
    ->prefix('secretaria')
    ->name('secretaria.')
    ->group(function () {
        Route::get('/home', function () {
            $roles = Role::where('acesso', '!=', 'admin')->get();
            $escolas = in_array(Auth::user()->role->acesso, ['secretaria', 'direcao'])
                        ? collect([Auth::user()->escola])
                        : Escola::all();
            $cursos = \App\Models\Curso::where('ativo', true)->get(); 

            return view('perfis.secretaria.sec-home', compact('roles', 'escolas', 'cursos'));
        })->name('home');
       
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
            return view('perfis.coordenadacao.coodernador-home');
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