<div class="max-w-3xl mx-auto mt-6">

<<<<<<< HEAD:resources/views/livewire/post/edit.blade.php
    <!-- COMMUNITY -->
    <div class="text-sm text-gray-500 mb-2">
        r/{{ $post->community->name ?? '-' }}
    </div>

    <!-- POST CARD -->
    <div class="bg-white border rounded-xl p-6">

        <!-- AUTHOR + ACTION -->
        <div class="flex items-start justify-between mb-4">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>

                <div>
                    <p class="font-semibold">
                        {{ $post->user->name ?? 'Unknown' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ optional($post->created_at)->diffForHumans() }}
                    </p>
                </div>
            </div>

            {{-- EDIT / DELETE --}}
            @auth
                @if (auth()->id() === $post->user_id)
                    <div class="flex items-center gap-2 text-sm">

                        <!-- EDIT -->
                        <a href="{{ route('posts.edit', $post) }}"
                           class="text-purple-600 hover:underline">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <button
                            wire:click="deletePost"
                            wire:confirm="Yakin ingin menghapus post ini?"
                            class="text-red-500 hover:underline">
                            Delete
                        </button>

                    </div>
                @endif
            @endauth

        </div>

        <!-- TITLE -->
        <h1 class="text-2xl font-bold mb-4">
            {{ $post->title }}
        </h1>

        <!-- CONTENT : TEXT -->
        @if ($post->type === 'text' && $post->content)
            <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                {{ $post->content }}
            </p>
        @endif

        <!-- CONTENT : IMAGE -->
        @if ($post->type === 'image' && $post->images->count())
            <div class="mt-4 space-y-3">
                @foreach ($post->images as $img)
                    <img
                        src="{{ asset('storage/' . $img->file_path) }}"
                        alt="Post image"
                        class="rounded-lg border w-full">
                @endforeach
            </div>
        @endif

        <!-- CONTENT : LINK -->
        @if ($post->type === 'link' && $post->url)
            <div class="mt-4">
                <a href="{{ $post->url }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="text-purple-600 underline break-all">
                    {{ $post->url }}
                </a>
            </div>
        @endif

        <!-- FOOTER -->
        <div class="flex items-center gap-6 text-sm text-gray-500 mt-6">
            <span>👁 {{ $post->views }}</span>
            <span>💬 {{ $post->comments_count ?? $post->comments->count() }}</span>
        </div>

    </div>

    <!-- COMMENTS -->
    <div class="mt-6 space-y-4">
        <h2 class="font-semibold text-lg">Komentar</h2>

        @forelse ($post->comments as $comment)
            <div class="bg-white border rounded-lg p-4">
                <p class="font-semibold text-sm">
                    {{ $comment->user->name ?? 'Anonymous' }}
                </p>
                <p class="text-gray-700 whitespace-pre-line">
                    {{ $comment->content }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">Belum ada komentar</p>
        @endforelse
    </div>
=======
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
                    class="px-5 py-2 bg-purple-600 text-white rounded-full font-semibold">
                Update Post
            </button>

            <button type="button" wire:click="cancel"
                    class="px-5 py-2 border rounded-full">
                Batal
            </button>
        </div>

    </form>
>>>>>>> a068ad99591de780c1e9d42585b862f42cb5ba36:resources/views/livewire/pages/post/edit.blade.php

</div>
