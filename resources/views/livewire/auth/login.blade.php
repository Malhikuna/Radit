<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center
            bg-gradient-to-br from-[#9966CC]/40 to-[#E6D9F2]">

    <div class="bg-white w-[360px] p-8 rounded-xl border border-gray-300 shadow-sm">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex flex-col items-center mb-6">
            <img src="{{ asset('icon/logo.png') }}" alt="Logo RADIT" class="h-14 mb-2" style="
                filter:
                    invert(59%)
                    sepia(25%)
                    saturate(750%)
                    hue-rotate(230deg)
                    brightness(96%)
                    contrast(94%);
            ">
            <span class="font-bold text-xl text-[#9966CC]">radit</span>
        </a>

        {{-- ERROR INTERAKTIF --}}
        @if($loginError)
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm text-center">
                {{ $loginError }}
            </div>
        @endif

        {{-- FORM LOGIN --}}
        <form wire:submit.prevent="login">

            {{-- Email --}}
            <div class="mb-4">
                <input wire:model.defer="email" type="email" placeholder="Email *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('email') border-red-500 @enderror">
                @error('email') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <input wire:model.defer="password" type="password" placeholder="Password *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('password') border-red-500 @enderror">
                @error('password') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Link Lupa Password --}}
            <div class="mb-4 text-right">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-700">
                    Lupa Password?
                </a>
            </div>

            {{-- Tombol Login --}}
            <button type="submit" class="w-full border border-gray-300 rounded-full py-2 font-bold hover:bg-gray-100 transition">
                Login
            </button>
        </form>

        <div class="my-6 text-center text-gray-400 text-sm">atau</div>

        {{-- Login Google --}}
        <a href="/auth/google" class="flex items-center justify-center gap-3 border border-gray-300 py-2 rounded-full mb-3 hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
            <span>Login dengan Google</span>
        </a>

        {{-- Login GitHub --}}
        <a href="/auth/github" class="flex items-center justify-center gap-3 border border-gray-300 py-2 rounded-full hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-5 h-5" alt="GitHub">
            <span>Login dengan GitHub</span>
        </a>

        <p class="text-center mt-6 text-sm">
            Belum punya akun?
            <a href="/register" class="text-[#9966CC] font-semibold hover:underline transition">Daftar</a>
        </p>
    </div>
</div>
