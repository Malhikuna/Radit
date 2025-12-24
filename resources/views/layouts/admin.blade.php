<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0 flex flex-col">
        <div class="p-6 font-bold text-xl border-b border-gray-700">
            Admin Panel
        </div>
        <nav class="p-4 flex-1">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.users') ? 'bg-gray-700' : '' }}">
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts') }}" class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.posts') ? 'bg-gray-700' : '' }}">
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.communities') }}" class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.communities') ? 'bg-gray-700' : '' }}">
                        Communities
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports') }}" class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.reports') ? 'bg-gray-700' : '' }}">
                        Reports
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 p-2 rounded hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6 overflow-auto">
        {{ $slot }} {{-- Livewire akan render component di sini --}}
    </main>

    @livewireScripts
</body>
</html>
