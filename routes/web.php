<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Http\Controllers\SocialAuthController;
use App\Livewire\Home;
use App\Livewire\Post\Create;

Route::get('/counter', Counter::class);

Route::get('/', Home::class);
Route::get('/', Home::class)->name('home');

Route::get('/create-thread', Create::class);

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::post('/logout', function () {
    // auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');