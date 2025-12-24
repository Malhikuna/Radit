<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Home;
use App\Livewire\Search\Show as SearchShow;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

use App\Livewire\Post\Create as PostCreate;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\Post\Edit as PostEdit;

use App\Livewire\Community\Index as CommunityIndex;
use App\Livewire\Community\Create as CommunityCreate;
use App\Livewire\Community\Edit as CommunityEdit;
use App\Livewire\Community\Show as CommunityShow;

use App\Livewire\Premium\Checkout;

use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', Home::class)
    ->name('home');

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search', SearchShow::class)->name('search');

/*
|--------------------------------------------------------------------------
| POSTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/create-thread', PostCreate::class)->name('posts.create');
    Route::get('/posts/{post}/edit', PostEdit::class)->name('posts.edit');
});

Route::get('/posts/{post}', PostShow::class)->name('posts.show');

/*
|--------------------------------------------------------------------------
| COMMUNITIES
|--------------------------------------------------------------------------
*/

Route::prefix('communities')->name('communities.')->group(function () {
    Route::get('/', CommunityIndex::class)->name('index');
    Route::get('/create', CommunityCreate::class)->name('create');
    Route::get('/{community}', CommunityShow::class)->name('show');
    Route::get('/{community}/edit', CommunityEdit::class)->name('edit');
});

/*
|--------------------------------------------------------------------------
| PREMIUM - Payment Gateway
|--------------------------------------------------------------------------
*/

Route::get('/checkout', Checkout::class)->name('checkout');
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| PREMIUM - Payment Gateway
|--------------------------------------------------------------------------
*/

Route::get('/checkout', Checkout::class)->name('checkout');
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::post('/logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');