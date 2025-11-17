<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('landing-page');
})->name('landing'); // <-- nome único

Route::get('/home', function () {
    return view('home');
})->name('home'); // <-- rota pública do usuário comum

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// ==============================
// SECRETARIA
// ==============================
Route::middleware(['auth','role:secretaria'])
    ->prefix('secretaria')
    ->name('secretaria.')
    ->group(function () {

        Route::get('/home', function () {
            return view('perfis.secretaria.sec-home');
        })->name('home'); // vira secretaria.home
    });


// ==============================
// CONFIGURAÇÕES
// ==============================
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
