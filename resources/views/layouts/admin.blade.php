<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">

{{-- SIDEBAR --}}
<aside class="w-64 bg-gradient-to-b from-[#9966CC] to-[#7A49A6] text-white flex flex-col">
    
    {{-- Logo --}}
    <div class="px-6 py-5 text-2xl font-bold tracking-wide border-b border-white/20">
        Admin Panel
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-6 space-y-2">
        @php
            $menuClass = 'flex items-center gap-3 px-4 py-2 rounded-lg transition';
            $active = 'bg-white/20';
            $hover = 'hover:bg-white/10';
        @endphp

        <a href="{{ route('admin.dashboard') }}"
           class="{{ $menuClass }} {{ request()->routeIs('admin.dashboard') ? $active : $hover }}">
            <x-lucide-layout-dashboard class="w-5"/>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.users') }}"
           class="{{ $menuClass }} {{ request()->routeIs('admin.users') ? $active : $hover }}">
           <x-lucide-users class="w-5"/> 
           <span>Users</span>
        </a>

        <a href="{{ route('admin.posts') }}"
           class="{{ $menuClass }} {{ request()->routeIs('admin.posts') ? $active : $hover }}">
           <x-lucide-sticky-note class="w-5"/> 
           <span>Posts</span>
        </a>

        <a href="{{ route('admin.communities') }}"
           class="{{ $menuClass }} {{ request()->routeIs('admin.communities') ? $active : $hover }}">
           <x-lucide-globe class="w-5"/> 
           <span>Communities</span>
        </a>

        <a href="{{ route('admin.reports') }}"
           class="{{ $menuClass }} {{ request()->routeIs('admin.reports') ? $active : $hover }}">
           <x-lucide-flag class="w-5"/>  
           <span>Reports</span>
        </a>
    </nav>

    {{-- Logout --}}
    <div class="p-4 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full bg-white text-[#7A49A6] font-semibold py-2 rounded-lg hover:bg-gray-100 transition">
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="flex-1 p-6 overflow-y-auto">
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
