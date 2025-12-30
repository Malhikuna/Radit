<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        // IKlan Premim
    Blade::if('ads', function () {
        return !auth()->check() || !auth()->user()->isPremiumActive();
    });

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