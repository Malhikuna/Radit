<aside class="fixed top-20 right-0 w-80 h-[calc(100vh-5rem)] px-6 py-6 space-y-6 overflow-y-auto">

    {{-- COMMUNITY INFO --}}
    <div class="bg-white rounded-xl border p-4">
        <h3 class="font-semibold mb-2">About Community</h3>
        <p class="text-sm text-gray-600">
            Tempat diskusi, berbagi cerita, dan posting konten menarik.
        </p>

        <div class="mt-4 text-sm text-gray-500 space-y-1">
            <div class="flex items-center gap-2">
                <x-heroicon-o-user-group class="w-5 h-5" />
                <span>1.234 Members</span>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-o-signal class="w-5 h-5 text-green-500" />
                <span>23 Online</span>
            </div>
        </div>

        <button class="mt-4 w-full bg-orange-600 text-white py-2 rounded-full font-semibold hover:bg-orange-700">
            Join
        </button>
    </div>

    {{-- RULES --}}
    <div class="bg-white rounded-xl border p-4">
        <h3 class="font-semibold mb-2">Community Rules</h3>
        <ul class="text-sm text-gray-600 space-y-2">
            <li>1. Jangan spam</li>
            <li>2. Sopan & santun</li>
            <li>3. No SARA</li>
        </ul>
    </div>

    {{-- TRENDING --}}
    <div class="bg-white rounded-xl border p-4">
        <h3 class="font-semibold mb-2">Trending</h3>
        <ul class="text-sm text-gray-600 space-y-2">
            <li>#Laravel</li>
            <li>#Unpas</li>
            <li>#WebDev</li>
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
