<div class="max-w-3xl mx-auto mt-6">

    <form wire:submit.prevent="update" class="space-y-4 bg-white p-6 border rounded-xl">

        {{-- TITLE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Judul</label>
            <input
                type="text"
                wire:model.defer="post.title"
                class="w-full border rounded-lg px-4 py-2"
            >
            @error('post.title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- CONTENT --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Konten</label>
            <textarea
                wire:model.defer="post.content"
                rows="5"
                class="w-full border rounded-lg px-4 py-2"
            ></textarea>
        </div>

        {{-- URL --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Link (optional)</label>
            <input
                type="url"
                wire:model.defer="post.url"
                class="w-full border rounded-lg px-4 py-2"
            >
        </div>

        {{-- TYPE --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Tipe Post</label>
            <select
                wire:model="post.type"
                class="w-full border rounded-lg px-4 py-2"
            >
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="link">Link</option>
            </select>
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3">
            <button
                type="submit"
                class="px-5 py-2 bg-orange-600 text-white rounded-full font-semibold"
            >
                Update Post
            </button>

            <a
                href="{{ route('posts.show', $post) }}"
                class="px-5 py-2 border rounded-full"
            >
                Batal
            </a>
        </div>

    </form>

</div>
