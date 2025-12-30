<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            this.updateHtml();
        },
        updateHtml() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="updateHtml(); $watch('darkMode', val => updateHtml())"
>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>{{ $title ?? 'Enable404' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-800 antialiased"
>

    {{-- NAVBAR --}}
    @if (!($hideNavbar ?? false))
        <livewire:shared.navbar />
    @endif

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @if (!($hideSidebar ?? false))
            <div class="hidden lg:block lg:w-64">
                <livewire:shared.sidebar />
            </div>
        @endif

        {{-- MAIN CONTENT --}}
        @php
            $isChat = request()->routeIs('chat');
            $isPremium = request()->routeIs('premium');
            $isLogin = request()->routeIs('login');
            $isRegister = request()->routeIs('register');
            $px = $isPremium || $isChat || $isLogin || $isRegister ? 'px-0' : 'px-6';
            $pt = ($hideSidebar ?? false) ? 'pt-0' : 'pt-20';
        @endphp

        <main role="main" class="flex-1 {{ $pt }} {{ $px }}">
            {{ $slot }}
        </main>


        {{-- SIDEBAR KANAN --}}
        @if (!(($hideSidebar ?? false) || ($hideRightbar ?? false)))
            <div class="hidden lg:block lg:w-80">
                <livewire:shared.rightbar />
            </div>
        @endif

    </div>

    @livewireScripts
    @stack('scripts')
    
</body>

</html>
