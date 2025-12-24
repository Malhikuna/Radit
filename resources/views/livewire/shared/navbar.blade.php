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

<<<<<<< HEAD
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
=======
            @auth
                <a 
                    href="/"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium
                            {{ 
                                request('sort') === 'popular'
                                ? 'bg-orange-50 text-orange-600'
                                : 'text-gray-700 hover:bg-gray-100 hover:text-orange-600' 
                            }}"
                >
                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-6 h-6" />
                </a>

                <a 
                    href="/"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium
                            {{ 
                                request('sort') === 'popular'
                                ? 'bg-orange-50 text-orange-600'
                                : 'text-gray-700 hover:bg-gray-100 hover:text-orange-600' 
                            }}"
                >
                    <x-heroicon-o-bell class="w-6 h-6" />
                </a>
                
                {{-- CREATE POST --}}
                <a  
                    href="{{ route('posts.create') }}"
                    class="flex gap-2 items-center px-3 py-1 rounded-full bg-orange-600 text-white font-semibold hover:bg-orange-700 transition">
                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                    Create
                </a>

                {{-- USER DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="w-8 h-8 rounded-full bg-orange-500 text-white flex items-center justify-center font-bold cursor-pointer hover:outline-none hover:ring-4 hover:ring-black/10 hover:border-black/10">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">

                        <a 
                            href="#"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <a 
                            href="#"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Settings
                        </a>

                        <a 
                            href="#"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Dark Mode
                        </a>

                        <a 
                            href="#"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 text-blue-400">
                            Radit+
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a 
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-orange-600">
                    Login
                </a>

                <a 
                    href="{{ route('register') }}"
                    class="px-4 py-2 rounded-full border font-semibold hover:bg-gray-100">
                    Register
                </a>
            @endguest
>>>>>>> 1818514 (feat: added dashboard, settings, draft folder & empty file, style: changed some ui & changed basic icon to hero icon)

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
