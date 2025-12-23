<nav class="fixed top-0 left-0 right-0 h-20 bg-white border-b z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <a href="{{ route('home') }}"
           class="flex items-center gap-2 font-bold text-orange-600 text-xl">
            <span class="text-2xl">🟠</span>
            RADIT
        </a>

        {{-- SEARCH --}}
        <form action="{{ route('search') }}" method="GET" class="flex-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari disini..."
                class="w-full bg-gray-100 rounded-full px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
        </form>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">

            @auth
                {{-- CREATE POST --}}
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 rounded-full bg-orange-600 text-white font-semibold
                          hover:bg-orange-700 transition">
                    Create
                </a>

                {{-- USER DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="w-10 h-10 rounded-full bg-orange-500
                                   text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-40 bg-white border
                                rounded-lg shadow-lg overflow-hidden">

                        <a href="#"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm
                                       hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="text-sm font-semibold text-gray-600 hover:text-orange-600">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="px-4 py-2 rounded-full border font-semibold
                          hover:bg-gray-100">
                    Register
                </a>
            @endguest

        </div>
    </div>
</nav>
