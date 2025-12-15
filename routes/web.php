<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;
use App\Livewire\Home;

Route::get('/counter', Counter::class);

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/create-thread', function () {
    return view('thread.create');
});
Route::get('/', Home::class);