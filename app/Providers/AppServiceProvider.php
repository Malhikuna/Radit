<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Community;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('livewire.shared.sidebar', function ($view) {

            $userId = Auth::id();

            // Following community (yang di-join user)
            $followingCommunities = $userId
                ? Community::whereHas('members', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })->get()
                : collect();

            // Discover community (global)
            $communities = Community::latest()->take(3)->get();

            $view->with([
                'followingCommunities' => $followingCommunities,
                'communities' => $communities,
            ]);
        });
    }
}