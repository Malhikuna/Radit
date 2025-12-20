<nav class="fixed top-0 left-0 right-0 h-20 bg-white border-b z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <div class="flex items-center gap-2 font-bold text-orange-600 text-xl">
            <span class="text-2xl">🟠</span>
            RADIT
        </div>

        {{-- SEARCH --}}
        <div class="flex-1">
            <input
                type="text"
                placeholder="Cari disini..."
                class="w-full bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
            >
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('posts.create') }}"
               class="px-4 py-2 rounded-full bg-orange-600 text-white font-semibold hover:bg-orange-700">
                Create
            </a>

            <div class="w-10 h-10 rounded-full bg-orange-500 text-white flex items-center justify-center font-bold">
                R
            </div>
        </div>
    </div>
</nav>
