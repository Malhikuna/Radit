<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow">
        <h1 class="text-2xl font-bold text-center mb-6">Register</h1>

        <form wire:submit.prevent="register" class="space-y-4">
            <input wire:model.defer="name"
                   type="text"
                   placeholder="Nama"
                   class="w-full border px-4 py-2 rounded-lg">

            <input wire:model.defer="email"
                   type="email"
                   placeholder="Email"
                   class="w-full border px-4 py-2 rounded-lg">

            <input wire:model.defer="password"
                   type="password"
                   placeholder="Password"
                   class="w-full border px-4 py-2 rounded-lg">

            <input wire:model.defer="password_confirmation"
                   type="password"
                   placeholder="Konfirmasi Password"
                   class="w-full border px-4 py-2 rounded-lg">

            <button class="w-full bg-black text-white py-2 rounded-lg">
                Register
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Sudah punya akun?
            <a href="/login" class="underline">Login</a>
        </p>
    </div>
</div>
