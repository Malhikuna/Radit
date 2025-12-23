<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
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
=======
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

use App\Http\Controllers\SocialAuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/counter', Counter::class);

Route::get('/', Home::class)
    ->name('home');

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/search', Search::class)
    ->name('search');

/*
|--------------------------------------------------------------------------
| POSTS (REDDIT STYLE CRUD)
|--------------------------------------------------------------------------
| Create  -> /create-thread
| Show    -> /posts/{post}
| Edit    -> /posts/{post}/edit
| Update  -> Livewire method
| Delete  -> Livewire method
*/

Route::middleware('auth')->group(function () {

    Route::get('/create-thread', PostCreate::class)
        ->name('posts.create');

    Route::get('/posts/{post}/edit', PostEdit::class)
        ->name('posts.edit');
});

Route::get('/posts/{post}', PostShow::class)
    ->name('posts.show');

/*
|--------------------------------------------------------------------------
| COMMUNITIES
|--------------------------------------------------------------------------
*/

Route::prefix('communities')
    ->name('communities.')
    ->group(function () {

        Route::get('/', CommunityIndex::class)
            ->name('index');

        Route::get('/create', CommunityCreate::class)
            ->name('create');

        Route::get('/{community}', CommunityShow::class)
            ->name('show');

        Route::get('/{community}/edit', CommunityEdit::class)
            ->name('edit');
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
>>>>>>> 235d953b77b221caa7e2489c340946dc09ab07f7

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::post('/logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();
<<<<<<< HEAD
    return redirect('/login');
})->name('logout');
=======

    return redirect()->route('login');
})->name('logout');
>>>>>>> 235d953b77b221caa7e2489c340946dc09ab07f7
