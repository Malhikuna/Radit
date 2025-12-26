<nav class="fixed top-0 left-0 right-0 h-20 bg-white ring ring-gray-200 z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <a  
            href="{{ route('home') }}"
            class="flex items-center gap-2 font-bold text-[#3e2b2c] text-xl">
            <img src="{{ asset('storage/icon/logo.png') }}" alt="Logo" class="h-14 -mx-7">
            RADIT
        </a>

        {{-- SEARCH --}}
        <form action="{{ route('search') }}" method="GET" class="flex-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari disini..."
                class="w-full bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#3e2b2c]"
            >
        </form>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">

            @auth
                <a 
                    href="/"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium
                            {{ 
                                request('sort') === 'home'
                                ? 'bg-white text-[#3e2b2c]'
                                : 'text-gray-700 hover:bg-gray-100 hover:text-[#3e2b2c]' 
                            }}"
                >
                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-6 h-6" />
                </a>

                <a 
                    href="/"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium
                            {{ 
                                request('sort') === 'home'
                                ? 'bg-white text-[#3e2b2c]'
                                : 'text-gray-700 hover:bg-gray-100 hover:text-[#3e2b2c]' 
                            }}"
                >
                    <x-heroicon-o-bell class="w-6 h-6" />
                </a>
                
                {{-- CREATE POST --}}
                <a  
                    href="{{ route('posts.create') }}"
                    class="flex gap-2 items-center px-3 py-1 rounded-full bg-[#3e2b2c] text-white font-semibold hover:bg-[#3e2b2c] transition">
                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                    Create
                </a>

{{-- USER DROPDOWN --}}
@php
    $user = auth()->user();
    $seed = urlencode($user->name);
    $avatarStyle = 'avataaars';
    $avatarUrl = "https://api.dicebear.com/7.x/{$avatarStyle}/svg?seed={$seed}";
@endphp

<div x-data="{ open: false }" class="relative">
    <button
        @click="open = !open"
        class="w-9 h-9 rounded-full overflow-hidden
               ring-2 ring-[#3e2b2c]
               hover:ring-4 transition"
    >
        @if ($user->avatar)
            <img
                src="{{ asset('storage/' . $user->avatar) }}"
                alt="{{ $user->name }}"
                class="w-full h-full object-cover"
            >
        @else
            <img
                src="{{ $avatarUrl }}"
                alt="{{ $user->name }}"
                class="w-full h-full object-cover bg-white"
            >
        @endif
    </button>

    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 mt-3 w-44
               bg-white border border-gray-200
               rounded-xl shadow-lg overflow-hidden"
    >
        <a href="{{ route('profile') }}"
           class="block px-4 py-2 text-sm hover:bg-gray-100">
            Profile
        </a>

        <a href="#"
           class="block px-4 py-2 text-sm hover:bg-gray-100">
            Settings
        </a>

        <a href="#"
           class="block px-4 py-2 text-sm hover:bg-gray-100">
            Dark Mode
        </a>

        <a href="{{ route('checkout') }}"
           class="block px-4 py-2 text-sm text-blue-500 hover:bg-gray-100">
            Radit+
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full text-left px-4 py-2 text-sm
                       text-red-600 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</div>

            @endauth

            @guest
                <a 
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-[#3e2b2c]">
                    Login
                </a>

                <a 
                    href="{{ route('register') }}"
                    class="px-4 py-2 rounded-full border font-semibold hover:bg-gray-100">
                    Register
                </a>
            @endguest

        </div>
    </div>
</nav>
