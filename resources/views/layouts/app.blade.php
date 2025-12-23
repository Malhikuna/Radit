<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Enable404' }}</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-50 antialiased">

    {{-- NAVBAR --}}
    @if (!($hideNavbar ?? false))
        <livewire:shared.navbar />
    @endif

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @if (!($hideSidebar ?? false))
            <livewire:shared.sidebar />
        @endif

        {{-- MAIN CONTENT --}}
<<<<<<< HEAD
<<<<<<< HEAD
        <main role="main" class="flex-1 p-8">
            {{ $slot }}
        </main>

=======
        <main role="main" class="flex-1 {{ $hideSidebar ? "pt-0" : "pt-24" }} px-6">
            {{ $slot }}
        </main>
=======
        @if (!($hideSidebar ?? false))
            <main role="main" class="flex-1 pt-24 px-6">
                {{ $slot }}
            </main>
        @else
            <main role="main" class="flex-1 pt-0 px-6">
                {{ $slot }}
            </main>
        @endif
>>>>>>> 288cf78 (feat: added midtrans)

        {{-- SIDEBAR KANAN --}}
        @if (!($hideSidebar ?? false))
            <div class="hidden lg:block lg:w-80">
                <livewire:shared.rightbar />
            </div>
        @endif

>>>>>>> 7a159d0 (style: fixed layout)
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
