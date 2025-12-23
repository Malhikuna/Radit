<div class="min-h-screen flex items-center justify-center bg-gray-100">

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

        {{-- Form Register --}}
        <form wire:submit.prevent="register">

            {{-- Nama --}}
            <div class="mb-4">
                <input
                    wire:model.defer="name"
                    type="text"
                    placeholder="Nama *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full
                           focus:outline-none focus:border-gray-400">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <input
                    wire:model.defer="email"
                    type="email"
                    placeholder="Email *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full
                           focus:outline-none focus:border-gray-400">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <input
                    wire:model.defer="password"
                    type="password"
                    placeholder="Password *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full pr-12
                           focus:outline-none focus:border-gray-400">
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <input
                    wire:model.defer="password_confirmation"
                    type="password"
                    placeholder="Konfirmasi Password *"
                    class="w-full px-4 py-2 border border-gray-300 rounded-full pr-12
                           focus:outline-none focus:border-gray-400">
            </div>

            {{-- Button Register --}}
            <button
                type="submit"
                class="w-full border border-gray-300 rounded-full py-2 font-bold
                       hover:bg-gray-100 transition">
                Register
            </button>

        </form>

        {{-- Login --}}
        <p class="text-center mt-6 text-sm">
            Sudah punya akun?
            <a
                href="/login"
                class="text-blue-400 font-semibold hover:text-blue-700 transition-colors">
                Login
            </a>
        </p>

    </div>

</div>
