<div>
    {{-- SORT --}}
    <div class="flex gap-3 mb-4">
        <button wire:click="$set('sort','new')" 
                class="{{ $sort === 'new' ? 'font-bold' : '' }}">
            New
        </button>
        <button wire:click="$set('sort','best')" 
                class="{{ $sort === 'best' ? 'font-bold' : '' }}">
            Best
        </button>
    </div>
    <div class="max-w-3xl mx-auto">
@if(!auth()->check() || !auth()->user()->hasPremium())
    <x-ads />
@endif

</div>
    {{-- POSTS LIST --}}
    @foreach ($posts as $post)
        <livewire:components.card
            :post="$post"
            :key="'post-'.$post->id" />
    @endforeach
</div>

