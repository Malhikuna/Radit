<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    {{-- KOTAK LOGIN --}}
    <div class="bg-white w-[360px] p-8 rounded-xl border border-gray-300 shadow-sm">

        {{-- Logo --}}
        <div class="flex flex-col items-center mb-6">
            <img
                src="https://cdn-icons-png.flaticon.com/512/888/888879.png"
                class="w-16 mb-2"
                alt="logo">
            <span class="text-orange-500 font-bold text-xl">
                ENABLE 404
            </span>
        </div>

        {{-- Form Login --}}
        <form wire:submit.prevent="login">

            {{-- Email --}}
            <div class="mb-4">
                <input
                    wire:model.defer="email"
                    type="email"
                    placeholder="Email *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-gray-400">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <input
                    wire:model.defer="password"
                    type="password"
                    placeholder="Password *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full pr-12 focus:outline-none focus:border-gray-400">
            </div>

            {{-- Lupa Password --}}
            <p class="text-sm font-semibold mb-4 text-center text-blue-400 hover:text-blue-700 cursor-pointer">
                Lupa Password
            </p>

            {{-- Button Login --}}
            <button
                type="submit"
                class="w-full border border-gray-300 rounded-full py-2 font-bold hover:bg-gray-100 transition">
                Login
            </button>
        </form>

        {{-- Divider --}}
        <div class="my-6 text-center text-gray-400 text-sm">
            atau
        </div>

        {{-- Login Google --}}
        <a
            href="/auth/google"
            class="flex items-center justify-center gap-3 border border-gray-300 py-2 rounded-full mb-3 hover:bg-gray-50 transition">

            <img
                src="https://www.svgrepo.com/show/475656/google-color.svg"
                class="w-5 h-5"
                alt="Google">

            <span>Login dengan Google</span>
        </a>

        {{-- Login GitHub --}}
        <a
            href="/auth/github"
            class="flex items-center justify-center gap-3 border border-gray-300 py-2 rounded-full hover:bg-gray-50 transition">

            <img
                src="https://www.svgrepo.com/show/512317/github-142.svg"
                class="w-5 h-5"
                alt="GitHub">

            <span>Login dengan GitHub</span>
        </a>

        {{-- Register --}}
        <p class="text-center mt-6 text-sm">
            Belum punya akun?
            <a  
                href="/register"
                class="text-blue-400 font-semibold hover:text-blue-700 transition">
                Daftar
            </a>
        </p>

    </div>
</div>

</body>
</html>
