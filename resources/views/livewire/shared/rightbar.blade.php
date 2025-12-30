<aside class="fixed top-15 bottom-0 right-0 w-80 pr-6 py-6 space-y-6 overflow-y-auto scrollbar-hide">

    {{-- COMMUNITY INFO --}}
    @if($community)
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4 shadow-sm hover:shadow-md transition">
            <h3 class="font-semibold mb-2 text-gray-800 dark:text-white">About {{ $community->name }}</h3>

            {{-- Tampilkan deskripsi dengan HTML dari Trix editor --}}
            <div class="text-sm text-gray-600 dark:text-gray-100 space-y-2 prose dark:prose-invert max-w-none">
                {!! $community->description ?? '<p>Tempat diskusi, berbagi cerita, dan posting konten menarik.</p>' !!}
            </div>

            <div class="mt-4 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-300">
                <x-heroicon-o-user-group class="w-5 h-5 text-gray-600 dark:text-white" />
                <span>{{ number_format($community->members_count ?? 0) }} Members</span>
            </div>
        </div>
    @endif

    {{-- WEATHER --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4 shadow-sm hover:shadow-md transition relative">
        <h3 class="font-semibold mb-3 text-gray-800 dark:text-white">Cuaca</h3>
        <livewire:weather-public />
    </div>

    {{-- TRENDING --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4 shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-2 text-gray-800 dark:text-white">Trending</h3>
        <ul class="text-sm text-gray-600 space-y-2 dark:text-gray-200">
            @foreach($community->trendingTags ?? ['Laravel','Unpas','WebDev'] as $tag)
                <li class="hover:text-blue-500 cursor-pointer transition">#{{ $tag }}</li>
            @endforeach
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
