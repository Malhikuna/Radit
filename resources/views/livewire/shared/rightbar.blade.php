<aside class="fixed top-20 right-0 w-80 h-[calc(100vh-5rem)] pr-6 py-6 space-y-6 overflow-y-auto scrollbar-hide">

    {{-- COMMUNITY INFO --}}
    <div class="bg-white rounded-xl ring ring-gray-200 p-4 shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-2 text-gray-800">About Community</h3>

        <p class="text-sm text-gray-600">
            Tempat diskusi, berbagi cerita, dan posting konten menarik.
        </p>

        <div class="mt-4 text-sm text-gray-500 space-y-2">
            <div class="flex items-center gap-2">
                <x-heroicon-o-user-group class="w-5 h-5 text-gray-600" />
                <span>1.234 Members</span>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-s-signal class="w-5 h-5 text-green-500" />
                <span>23 Online</span>
            </div>
        </div>

        <button class="mt-4 w-full bg-orange-600 text-white py-2 rounded-full font-semibold hover:bg-orange-700 transition">
            Join
        </button>
    </div>

    {{-- WEATHER (LIVEWIRE) --}}
    <div class="bg-white rounded-xl ring ring-gray-200 p-4 shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-3 text-gray-800">Cuaca</h3>
        <livewire:weather-public />
    </div>

    {{-- TRENDING --}}
    <div class="bg-white rounded-xl ring ring-gray-200 p-4 shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-2 text-gray-800">Trending</h3>

        <ul class="text-sm text-gray-600 space-y-2">
            <li class="hover:text-blue-500 cursor-pointer transition">#Laravel</li>
            <li class="hover:text-blue-500 cursor-pointer transition">#Unpas</li>
            <li class="hover:text-blue-500 cursor-pointer transition">#WebDev</li>
        </ul>
    </div>

    {{-- FOOTER --}}
    <div class="text-xs text-gray-400 space-y-2">
        <p>© 2025 RADIT</p>

        <div class="flex flex-wrap gap-2">
            <a href="#" class="hover:underline">About</a>
            <a href="#" class="hover:underline">Help</a>
            <a href="#" class="hover:underline">Privacy</a>
            <a href="#" class="hover:underline">Terms</a>
        </div>
    </div>

</aside>
