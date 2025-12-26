<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Enable404' }}</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 antialiased">

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
        @if (!($hideSidebar ?? false))
            <main role="main" class="flex-1 pt-24 px-6">
                {{ $slot }}
            </main>
        @else
            <main role="main" class="flex-1 pt-0 px-6">
                {{ $slot }}
            </main>
        @endif

        {{-- SIDEBAR KANAN --}}
        @if (!($hideSidebar ?? false))
            <div class="hidden lg:block lg:w-80">
                <livewire:shared.rightbar />
            </div>
        @endif

    </div>

    @livewireScripts
    @stack('scripts')
    
</body>

</html>
