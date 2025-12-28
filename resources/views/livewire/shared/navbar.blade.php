<nav class="fixed top-0 left-0 right-0 h-20 bg-white ring ring-gray-200 z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <a  
            href="{{ route('home') }}"
            class="flex items-center gap-2 font-bold text-[#9966CC] text-xl">
            <img src="{{ asset('storage/icon/logo.png') }}" alt="Logo" class="h-14 -mx-3">
            RADIT
        </a>

        {{-- SEARCH --}}
        <form action="{{ route('search') }}" method="GET" class="flex-1">
            <div class="flex items-center bg-gray-100 rounded-full overflow-hidden">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari disini..."
                    class="flex-1 bg-transparent px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                >

                <button
                    type="submit"
                    class="px-6 py-2 bg-[#9966CC] text-white font-semibold hover:bg-[#7A49A6] transition">
                    Cari
                </button>
            </div>
        </form>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">
            @auth
                <a href="/" class="flex items-center px-2 py-2 rounded-full text-gray-700 hover:bg-gray-100">
                    <x-lucide-message-circle-more class="w-5"/>
                </a>

                <a href="/" class="flex items-center px-2 py-2 rounded-full text-gray-700 hover:bg-gray-100">
                    <x-lucide-bell class="w-5"/>
                </a>

                <a  
                    href="{{ route('posts.create') }}"
                    class="flex items-center px-1 py-1 rounded-full bg-[#9966CC] text-white hover:bg-[#7A49A6]">
                    <x-lucide-circle-plus class="w-6"/>
                </a>

                {{-- USER DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="w-8 h-8 rounded-full bg-[#9966CC] text-white font-bold flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Dark Mode</a>
                        <a href="#" class="block px-4 py-2 text-sm text-blue-400 hover:bg-gray-100">Radit+</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-purple-600">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full border font-semibold hover:bg-gray-100">
                    Register
                </a>
            @endguest
        </div>

    </div>
</nav>
