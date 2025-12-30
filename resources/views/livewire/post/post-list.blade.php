<div>
    {{-- SORT DROPDOWN (AMAN) --}}
    <div
        x-data="{ open: false }"
        class="relative inline-block text-left"
    >
        <!-- Trigger -->
        <button
            @click="open = !open"
            class="cursor-pointer inline-flex items-center gap-2
                px-2 py-1
                rounded-xl
                text-xs font-medium
                focus:outline-none hover:bg-gray-200 dark:text-white dark:hover:bg-gray-500"
        >
            {{ ucfirst($sort) }}
            <x-lucide-chevron-down class="w-3 h-3 dark:text-white"/>
        </button>

        <!-- Menu -->
        <div
            x-show="open"
            @click.away="open = false"
            class="absolute z-20 mt-2 w-28
                rounded-xl
                border border-gray-200 bg-white dark:bg-gray-700 dark:border-gray-500 shadow-lg overflow-hidden"
        >
            <button
                wire:click="$set('sort', 'new')"
                @click="open = false"
                class="block w-full px-4 py-2 text-left text-sm
                    hover:bg-[#9966CC]/10 dark:text-white dark:hover:bg-gray-500"
            >
                New
            </button>

            <button
                wire:click="$set('sort', 'best')"
                @click="open = false"
                class="block w-full px-4 py-2 text-left text-sm
                    hover:bg-[#9966CC]/10 dark:hover:bg-gray-500 dark:text-white"
            >
                Best
            </button>
        </div>
    </div>

    <div class="border-b mt-2 mb-4 border-black/10 w-full dark:border-gray-600"></div>

    <div class="max-w-3xl mx-auto">
        @ads
            <x-ad-banner />
        @endads
    </div>
    
    {{-- POSTS LIST --}}
    <div>
        @if($posts->isEmpty())
            <div class="text-center py-10 text-gray-500 bg-gray-50 dark:bg-gray-900 rounded-lg">
                Tidak ada postingan ditemukan.
            </div>
        @else
            @foreach($posts as $post)
                <livewire:components.card
                :post="$post"
                :key="'post-'.$post->id" />
            @endforeach
        @endif
    </div>

    {{-- LOADING --}}
    <div
        x-data
        x-intersect="$wire.loadMore()"
        class="flex justify-center mt-15 mb-15"
    >
        @if($hasMore)
            <div
                wire:loading.flex
                class="relative w-20 h-20 flex items-center justify-center"
            >
                <div class="bg-purple-200 pulse-ring"></div>

                <div
                    class="relative z-10
                        w-15 h-15
                        rounded-full
                        bg-[#9966CC]
                        flex items-center justify-center"
                >
                    <img
                        src="{{ asset('storage/icon/logo.png') }}"
                        alt="Logo"
                        class="block h-10 animate-pulse"
                    />
                </div>
            </div>
        @endif
    </div>  


</div>
