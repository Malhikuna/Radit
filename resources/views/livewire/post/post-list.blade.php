<div>
    {{-- SORT DROPDOWN (AMAN) --}}
    <div class="mb-4">
        <select
            wire:change="$set('sort', $event.target.value)"
            class="px-3 py-2 border rounded-lg bg-white text-sm
                   focus:outline-none focus:ring-2 focus:ring-[#9966CC]"
        >
            <option value="new" @selected($sort === 'new')>
                New
            </option>

            <option value="best" @selected($sort === 'best')>
                Best
            </option>
        </select>
    </div>

    <div class="max-w-3xl mx-auto">
        @ads
            <x-ad-banner />
        @endads
    </div>
    
    {{-- POSTS LIST --}}
    <div>
        @foreach ($posts as $post)
            <livewire:components.card
                :post="$post"
                :key="'post-'.$post->id" />
        @endforeach
    </div>

    {{-- LOADING --}}
    <div
        x-data
        x-intersect="$wire.loadMore()"
        class="h-10 flex justify-center mt-10"
    >
        @if($hasMore)
            <div
                wire:loading
                class="w-20 h-20
                    flex items-center justify-center
                    rounded-full
                    bg-[#9966CC]"
            >
                <img
                    src="{{ asset('storage/icon/logo.png') }}"
                    alt="Logo"
                    class="block h-10 animate-pulse"
                />
            </div>
        @endif
    </div>
</div>
