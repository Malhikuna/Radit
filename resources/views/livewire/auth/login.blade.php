<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow">
        <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

        <form wire:submit.prevent="login" class="space-y-4">
            <input wire:model.defer="email"
                   type="email"
                   placeholder="Email"
                   class="w-full border px-4 py-2 rounded-lg">

            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

            <input wire:model.defer="password"
                   type="password"
                   placeholder="Password"
                   class="w-full border px-4 py-2 rounded-lg">

            <button class="w-full bg-black text-white py-2 rounded-lg">
                Login
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Belum punya akun?
            <a href="/register" class="underline">Daftar</a>
        </p>

        <div class="my-6 text-center text-gray-400">atau</div>

        <a href="/auth/google" class="block text-center border py-2 rounded-lg mb-3">
            Login Google
        </a>

        <a href="/auth/github" class="block text-center border py-2 rounded-lg">
            Login GitHub
        </a>
    </div>
</div>
