<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| LIVEWIRE COMPONENTS
|--------------------------------------------------------------------------
*/
use App\Livewire\Home;
use App\Livewire\Search\Show as SearchShow;

/** Auth */
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\AdminLogin;
use App\Livewire\User\Profile;
use App\Livewire\User\UserProfile;

/** Posts */
use App\Livewire\Post\Create as PostCreate;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\Post\Edit as PostEdit;

/** Communities */
use App\Livewire\Community\Index as CommunityIndex;
use App\Livewire\Community\Create as CommunityCreate;
use App\Livewire\Community\Edit as CommunityEdit;
use App\Livewire\Community\Show as CommunityShow;

/** Premium */
use App\Livewire\Premium\Checkout;
use App\Livewire\Premium\Show as PremiumShow;

/** Admin */
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Posts;
use App\Livewire\Admin\Communities;
use App\Livewire\Admin\Reports;

use App\Http\Controllers\WeatherPublicController;


/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;
use Livewire\Livewire;

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
Route::get('/posts/{post}', PostShow::class)->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/create-thread', PostCreate::class)->name('posts.create');
    Route::get('/posts/{post}/edit', PostEdit::class)->name('posts.edit');
});

/*
|--------------------------------------------------------------------------
| COMMUNITIES
|--------------------------------------------------------------------------
*/
Route::prefix('communities')->name('communities.')->group(function () {
    Route::get('/', CommunityIndex::class)->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('/create', CommunityCreate::class)->name('create');
        Route::get('/{community}/edit', CommunityEdit::class)->name('edit');
    });

    Route::get('/{community}', CommunityShow::class)->name('show');
});

/*
|--------------------------------------------------------------------------
| PREMIUM / PAYMENT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
});
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::post('/logout', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (LIVEWIRE)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/users', Users::class)->name('users');
    Route::get('/posts', Posts::class)->name('posts');
    Route::get('/communities', Communities::class)->name('communities');
    Route::get('/reports', Reports::class)->name('reports');
});


/*
|--------------------------------------------------------------------------
| USER PROFILE
|--------------------------------------------------------------------------
*/
// Profil login user sendiri (private)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
});

// Profil publik user berdasarkan ID
Route::get('/user/{userId}', UserProfile::class)->name('user.profile');

/*
|--------------------------------------------------------------------------
| SHOW PREMIUM
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/premium', PremiumShow::class)->name('premium.show');
});



// Route::get('/weather-public', WeatherPublicController::class);