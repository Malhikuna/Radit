<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PremiumController;

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK (API)
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', [PremiumController::class, 'callback']);
