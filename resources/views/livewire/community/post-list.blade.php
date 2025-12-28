<div>
    {{-- SORT --}}
    <div class="flex gap-3 mb-4">
        <button
            wire:click="$set('sort','new')"
            class="px-3 py-1 rounded
                   {{ $sort === 'new' ? 'font-bold underline' : '' }}">
            New
        </button>

        <button
            wire:click="$set('sort','best')"
            class="px-3 py-1 rounded
                   {{ $sort === 'best' ? 'font-bold underline' : '' }}">
            Best
        </button>
    </div>

    {{-- POSTS LIST --}}
    <div class="space-y-4">
        @foreach ($posts as $post)
            <livewire:components.card
                :post="$post"
                :key="'post-'.$post->id" />
        @endforeach
    </div>

    {{-- INFINITE SCROLL TRIGGER --}}
    @if ($hasMore)
        <div
            x-data
            x-intersect="$wire.loadMore()"
            class="h-12 flex items-center justify-center mt-6"
        >
            <span wire:loading class="text-sm text-gray-500">
                Loading more posts...
            </span>
        </div>
    @endif
</div>
