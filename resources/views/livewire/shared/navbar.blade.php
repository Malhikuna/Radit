<nav class="w-full shadow-sm ring-gray-100 bg-white px-6 py-4">
    <div class="flex items-center justify-between gap-6">

        {{-- LOGO --}}
        <div class="flex items-center gap-3">
            <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" class="w-10" />
            <span class="font-bold text-xl text-orange-500 leading-none">RADIT</span>
        </div>

        {{-- SEARCH + FILTER --}}
        <div class="flex-1 max-w-2xl">

            {{-- SEARCH INPUT --}}
            <div class="flex items-center bg-white border border-gray-300 rounded-full px-4 py-2">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 10.5a7.5 7.5 0 0013.15 6.15z" />
                </svg>

                <input
                    type="text"
                    placeholder="Cari disini..."
                    class="w-full outline-none text-sm bg-transparent"
                />
            </div>

            {{-- FILTER BUTTON --}}
            <div class="flex gap-2 mt-2">
                <button class="px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                    All
                </button>
                <button class="px-4 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                    Posts
                </button>
                <button class="px-4 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                    Communities
                </button>
                <button class="px-4 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                    People
                </button>
            </div>

        </div>

        {{-- RIGHT ACTION --}}
        <div class="flex items-center gap-4">
            <button
                class="flex items-center gap-1 ring ring-gray-200 px-4 py-2 rounded-full hover:bg-gray-100"
                onclick="window.location='{{ url('/create-thread') }}'">
                <span>⚙️</span> Create
            </button>

            @auth
                <x-avatar :user="auth()->user()" size="40" />
            @endauth
        </div>

    </div>
</nav>
