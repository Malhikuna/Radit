<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RADIT' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <x-navbar />

    <div class="flex">

        {{-- SIDEBAR KIRI --}}
        <x-sidebar />

        {{-- MAIN FEED --}}
        <main class="flex-1 ml-64 mr-80 pt-24 px-6">
            {{ $slot }}
        </main>

        {{-- SIDEBAR KANAN --}}
        <x-rightbar />

    </div>

    @livewireScripts
</body>
</html>
