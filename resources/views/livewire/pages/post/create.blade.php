<div class="w-full max-w-4xl px-10 py-8 mx-auto">

    <h1 class="text-2xl font-semibold mb-6">Edit post</h1>

    <!-- COMMUNITY -->
    <div class="relative mb-4">
        <!-- Search Input -->
        <input type="text"
               wire:model.live="communitySearch"
               placeholder="Search community..."
               class="w-full border rounded-lg px-4 py-2">

        <!-- Dropdown Result -->
        @if ($communities && count($communities))
            <div class="absolute z-10 bg-white border rounded-lg w-full mt-1 shadow">
                @foreach ($communities as $community)
                    <div wire:click="selectCommunity({{ $community->id }})"
                         class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <div class="flex items-center gap-2">
                            <x-community-icon :community="$community" size="24" />
                            <span>{{ $community->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <input type="hidden" wire:model="community_id">
    @error('community_id')
        <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
    @enderror

    <!-- TABS -->
    <div class="flex gap-6 border-b pb-2 text-sm mb-5">
        @foreach (['text','image','video','link','poll'] as $t)
            <button type="button" wire:click="setType('{{ $t }}')"
                class="{{ $type === $t
                    ? 'font-medium border-b-2 border-blue-600 pb-2 text-blue-600'
                    : 'text-gray-600' }}">
                {{ ucfirst($t) }}
            </button>
        @endforeach
    </div>

    <!-- TITLE -->
    <input type="text"
           wire:model.live="title"
           placeholder="Title*"
           class="w-full border rounded-lg px-4 py-2 mb-1">
    <div class="text-right text-xs text-gray-500 mb-3">
        {{ strlen($title) }}/255
    </div>
    @error('title')
        <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
    @enderror

    <!-- TEXT POST -->
    @if ($type === 'text')
        <textarea wire:model.defer="content"
                  placeholder="Body text (optional)"
                  class="w-full h-40 border rounded-lg px-4 py-3 mb-4 resize-none"></textarea>
    @endif

    <!-- LINK POST -->
    @if ($type === 'link')
        <input type="url"
               wire:model.defer="url"
               placeholder="https://example.com"
               class="w-full border rounded-lg px-4 py-2 mb-4">
        @error('url')
            <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
        @enderror
    @endif

    <!-- IMAGE POST -->
    @if ($type === 'image')
        <input type="file"
               wire:model="image"
               accept="image/*"
               class="w-full border rounded-lg px-4 py-2 mb-4">
        @error('image')
            <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
        @enderror

        @if ($image)
            <img src="{{ $image->temporaryUrl() }}"
                 class="rounded-xl max-h-64 mx-auto mb-4">
        @elseif($post->images->count())
            <img src="{{ asset('storage/' . $post->images->first()->file_path) }}"
                 class="rounded-xl max-h-64 mx-auto mb-4">
        @endif
    @endif

    <!-- SUBMIT -->
    <div class="flex justify-end gap-3">
        <button type="button"
                class="px-5 py-2 rounded-full border text-gray-600"
                wire:click="cancel">
            Cancel
        </button>

        <button wire:click="update"
                class="px-6 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700">
            Update
        </button>
    </div>

</div>
