<div class="max-w-3xl mx-auto mt-6">

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
                           class="text-orange-600 hover:underline">
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
                   class="text-orange-600 underline break-all">
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

</div>
