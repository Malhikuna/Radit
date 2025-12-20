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
        <main role="main" class="flex-1 p-8">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
