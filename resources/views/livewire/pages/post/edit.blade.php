<div class="max-w-3xl mx-auto mt-6">

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4 bg-white p-6 border rounded-xl">

        {{-- TITLE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Judul</label>
            <input type="text"
                   wire:model.defer="title"
                   class="w-full border rounded-lg px-4 py-2">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- CONTENT --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Konten</label>
            <textarea wire:model.defer="content"
                      rows="5"
                      class="w-full border rounded-lg px-4 py-2"></textarea>
            @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- URL --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Link (optional)</label>
            <input type="url"
                   wire:model.defer="url"
                   class="w-full border rounded-lg px-4 py-2">
            @error('url') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- TYPE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Tipe Post</label>
            <select wire:model="type"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="link">Link</option>
                <option value="video">Video</option>
                <option value="poll">Poll</option>
            </select>
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- IMAGE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Upload Gambar (optional)</label>
            <input type="file" wire:model="image" class="w-full">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- COMMUNITY SEARCH --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Pilih Community</label>
            <input type="text" wire:model="communitySearch" placeholder="Cari community..."
                   class="w-full border rounded-lg px-4 py-2">
            <div class="mt-1 space-y-1">
                @foreach($communities as $c)
                    <div wire:click="selectCommunity({{ $c->id }})"
                         class="cursor-pointer px-2 py-1 hover:bg-gray-200 rounded">
                        {{ $c->name }}
                    </div>
                @endforeach
            </div>
            @error('community_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="px-5 py-2 bg-orange-600 text-white rounded-full font-semibold">
                Update Post
            </button>

            <button type="button" wire:click="cancel"
                    class="px-5 py-2 border rounded-full">
                Batal
            </button>
        </div>

    </form>

</div>
