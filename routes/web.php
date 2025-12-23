<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Counter;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Search;

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;

use App\Livewire\Pages\Post\Create as PostCreate;
use App\Livewire\Pages\Post\Show as PostShow;
use App\Livewire\Pages\Post\Edit as PostEdit;

use App\Livewire\Pages\Community\Index as CommunityIndex;
use App\Livewire\Pages\Community\Create as CommunityCreate;
use App\Livewire\Pages\Community\Edit as CommunityEdit;
use App\Livewire\Pages\Community\Show as CommunityShow;

use App\Livewire\Premium\Checkout;

use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/counter', Counter::class);
Route::get('/', Home::class)->name('home');

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search', Search::class)->name('search');

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
