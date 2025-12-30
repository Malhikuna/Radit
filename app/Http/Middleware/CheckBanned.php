<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user && $user->isBanned()) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors(['account' => 'Akun anda telah dibanned.']);
        }

        return $next($request);
    }
}
