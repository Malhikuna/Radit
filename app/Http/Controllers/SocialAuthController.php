<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('loginError', 'Login via '.$provider.' gagal.');
        }

        if (!$socialUser->getEmail()) {
            return redirect()->route('login')->with('loginError', 'Email tidak tersedia dari '.$provider);
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'member',
            ]
        );

        Auth::login($user, true);

        return redirect()->intended('/');
    }
}
