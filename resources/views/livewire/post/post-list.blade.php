<div>
    {{-- SORT DROPDOWN --}}
    <div class="mb-4 flex items-center gap-2">
        <span class="text-sm text-gray-500 font-medium">Sort</span>

        <div class="relative">
            <select
                wire:model.live="sort"
                class="appearance-none cursor-pointer
                       bg-white text-sm font-semibold text-gray-700
                       border border-gray-300
                       rounded-full px-4 py-2 pr-9
                       shadow-sm
                       hover:border-[#3e2b2c]
                       focus:outline-none
                       focus:ring-2 focus:ring-[#3e2b2c]
                       transition"
            >
                <option value="new">🆕 New</option>
                <option value="best">🔥 Best</option>
                <option value="discussed">💬 Most Discussed</option>
                <option value="old">⏳ Oldest</option>
            </select>

            {{-- Arrow --}}
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>

    {{-- POSTS LIST --}}
    @foreach ($posts as $post)
        <livewire:components.card
            :post="$post"
            :key="'post-'.$post->id" />
    @endforeach

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
