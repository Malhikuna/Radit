<nav class="fixed top-0 left-0 right-0 h-15 bg-white dark:bg-gray-900 ring ring-gray-200 dark:ring-gray-700 z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <a  
            href="{{ route('home') }}"
            class="flex items-center gap-1 font-bold text-[#9966CC] dark:text-white">
            <img src="{{ asset('icon/logo.png') }}" alt="Logo" class="h-14">
            <span class="text-3xl text-shadow-[0_0_1px_#b598d1]">radit</span>
        </a>

        {{-- SEARCH --}}
        <form action="{{ route('search') }}" method="GET" class="flex-1">
            <livewire:search.global-search />
        </form>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">
            @auth
                @php
                    $isChat = request()->routeIs('chat');
                @endphp

                @if (!$isChat)
                    <livewire:chat.chat-widget />
                @endif

                <a 
                    href="{{ route('notification.show') }}"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium dark:hover:text-white dark:text-white
                            {{ 
                                request('sort') === 'home'
                                ? 'bg-purple-50 text-purple-600'
                                : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-400 hover:text-purple-600' 
                            }}"
                >
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
                            class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold cursor-pointer border-2 border-yellow-400 hover:outline-none hover:ring-3 hover:ring-yellow-400 hover:border-yellow-400 transition">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute flex flex-col right-0 mt-2 w-50 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-900 rounded-lg shadow-lg overflow-hidden">

                        <a href="{{ route('profile') }}" class="flex gap-4 px-4 py-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white">
                            <x-lucide-circle-user class="w-5 dark:text-white"/> Profile
                        </a>
                        
                        
                        <a 
                        href="#"
                        class="flex gap-4 px-4 py-4 text-sm hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                            <x-lucide-settings class="w-5 dark:text-white"/> Settings
                        </a>
                        
                        <button 
                        @click="toggleTheme()"
                        class="cursor-pointer flex gap-4 px-4 py-4 text-sm hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                            <x-lucide-moon x-show="!darkMode" class="w-5"/> 

                            <x-lucide-sun x-show="darkMode" class="w-5" />
                            
                            Dark Mode
                        </button>
                        
                        <a 
                            href="{{ route('premium') }}"
                            class="relative group flex items-center gap-4 px-4 py-4 text-sm overflow-hidden hover:bg-blue-50 dark:hover:bg-blue-50/60 transition-all duration-300 dark:text-white"
                        >
                            <span class="absolute right-3 top-2 w-1.5 h-1.5 bg-blue-400 dark:bg-white rounded-full animate-ping opacity-75"></span>

                            <span class="absolute right-10 top-4 w-1 h-1 bg-cyan-300 rounded-full animate-pulse opacity-100 dark:bg-white"></span>

                            <span class="absolute left-2 bottom-2 w-1 h-1 bg-blue-500 rounded-full animate-ping opacity-75 dark:bg-gray-100" style="animation-delay: 500ms; animation-duration: 1.5s;"></span>
                            
                            <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-blue-400/20 rounded-full blur-md animate-pulse opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            
                            <span class="absolute left-10 bottom-1 w-1 h-1 bg-cyan-500 rounded-full animate-bounce delay-100 opacity-50 dark:bg-white"></span>

                            <x-lucide-diamond-plus class="w-5 text-blue-600 relative z-10 group-hover:rotate-12 group-hover:scale-110 transition-all duration-300 dark:text-cyan-300 dark:hover:text-cyan-300"/>
                            
                            <span class="font-bold text-transparent bg-clip-text bg-linear-to-r from-blue-600 to-cyan-400 dark:from-cyan-300 dark:to-blue-500 relative z-10">
                                Radit+
                            </span>
                        </a>

                        <div class=""></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                            class="cursor-pointer border-t border-black/10 flex gap-4 w-full text-left px-4 py-4 text-sm hover:bg-gray-100 text-red-600 dark:text-white dark:hover:bg-gray-600">
                            <x-lucide-log-out class="w-5"/> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a 
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-[#9966CC]">
                    Login
                </a>

                <a 
                    href="{{ route('register') }}"
                    class="bg-[#9966CC] text-white px-4 py-2 rounded-full border font-semibold hover:bg-[#9966CC]/90">
                    Register
                </a>
            @endguest
        </div>

    </div>
</nav>



