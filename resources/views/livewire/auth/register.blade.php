<div class="min-h-screen flex items-center justify-center
            bg-gradient-to-br from-[#9966CC]/40 to-[#E6D9F2]">

    <div class="bg-white w-[360px] p-8 rounded-xl border border-gray-300 shadow-sm">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex flex-col items-center mb-6">
            <img 
                src="{{ asset('icon/logo.png') }}" 
                alt="Logo RADIT"
                class="h-14 mb-2"
                style="
                    filter:
                        invert(59%)
                        sepia(25%)
                        saturate(750%)
                        hue-rotate(230deg)
                        brightness(96%)
                        contrast(94%);
                "
            >
            <span class="font-bold text-xl text-[#9966CC]">
                radit
            </span>
        </a>

        {{-- PESAN DARI REGISTER / ERROR --}}
        @if(session('loginMessage'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700 text-sm text-center">
                {{ session('loginMessage') }}
            </div>
        @endif

        {{-- FORM REGISTER --}}
        <form wire:submit.prevent="register">

            {{-- Nama --}}
            <div class="mb-4">
                <input
                    wire:model.defer="name"
                    type="text"
                    placeholder="Nama *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('name') border-red-500 @enderror">
                @error('name') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <input
                    wire:model.defer="email"
                    type="email"
                    placeholder="Email *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('email') border-red-500 @enderror">
                @error('email') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <input
                    wire:model.defer="password"
                    type="password"
                    placeholder="Password *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('password') border-red-500 @enderror">
                @error('password') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <input
                    wire:model.defer="password_confirmation"
                    type="password"
                    placeholder="Konfirmasi Password *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-gray-400 @error('password_confirmation') border-red-500 @enderror">
                @error('password_confirmation') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            {{-- Button Register --}}
            <button
                type="submit"
                class="w-full border border-gray-300 rounded-full py-2 font-bold hover:bg-gray-100 transition">
                Register
            </button>

        </form>

        {{-- Login --}}
        <p class="text-center mt-6 text-sm">
            Sudah punya akun?
            <a
                href="/login"
                class="text-[#9966CC] font-semibold hover:underline transition">
                Login
            </a>
        </p>

    </div>
</div>
