<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Enable404')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="bg-gray-50">

    {{-- NAVBAR --}}
    <x-navbar/>

    <div class="flex">

        {{-- SIDEBAR --}}
        <x-sidebar/>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts

</body>
</html>
