<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| LIVEWIRE
|--------------------------------------------------------------------------
*/
use App\Livewire\Home;
use App\Livewire\Search as SearchShow;

/** Auth */
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
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

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialAuthController;
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
        Route::get('/create-thread/{community?}', PostCreate::class)->name('posts.create');
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
| PREMIUM / MIDTRANS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->post('/premium/pay', [PaymentController::class, 'pay']);
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

Route::get('/checkout/success', function () {
    return redirect('/')->with('success', 'Premium aktif 🎉');
})->name('checkout.success');

Route::get('/checkout/unfinish', function () {
    return redirect('/')->with('error', 'Pembayaran dibatalkan');
})->name('checkout.unfinish');

Route::get('/checkout/error', function () {
    return redirect('/')->with('error', 'Pembayaran gagal');
})->name('checkout.error');

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
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
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
Route::middleware('auth')->get('/profile', Profile::class)->name('profile');
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