<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Counter;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Http\Controllers\SocialAuthController;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Post\Create as PostCreate;
use App\Livewire\Pages\Community\Create as CommunityCreate;

Route::get('/counter', Counter::class);

Route::get('/', Home::class);
Route::get('/', Home::class)->name('home');

Route::get('/create-thread', PostCreate::class)
    ->name('posts.create');

Route::get('/communities/create', CommunityCreate::class)
    ->name('communities.create');

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
