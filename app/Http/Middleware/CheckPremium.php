<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPremium
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->is_premium && $user->premium_expired_at && $user->premium_expired_at->isPast()) {
            $user->update([
                'is_premium' => false,
                'premium_expired_at' => null,
            ]);
        }

        return $next($request);
    }
}
