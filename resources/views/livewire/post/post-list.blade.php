<div>
    {{-- SORT --}}
    <div class="flex gap-3 mb-4">
        <button wire:click="setSort('new')"
            class="{{ $sort === 'new' ? 'font-bold underline' : '' }}">
            New
        </button>

        <button wire:click="setSort('best')"
            class="{{ $sort === 'best' ? 'font-bold underline' : '' }}">
            Best
        </button>
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
        class="h-10 flex items-center justify-center mt-4"
    >
        @if($hasMore)
            <span wire:loading>Loading...</span>
        @endif
    </div>
</div>
