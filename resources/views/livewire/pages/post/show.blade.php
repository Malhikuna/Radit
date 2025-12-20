<div class="max-w-3xl mx-auto mt-6">

    <!-- COMMUNITY -->
    <div class="text-sm text-gray-500 mb-2">
        r/{{ $post->community->name }}
    </div>

    <!-- POST CARD -->
    <div class="bg-white border rounded-xl p-6">

        <!-- AUTHOR -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
            <div>
                <p class="font-semibold">{{ $post->user->name }}</p>
                <p class="text-xs text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        <!-- TITLE -->
        <h1 class="text-2xl font-bold mb-4">
            {{ $post->title }}
        </h1>

        <!-- CONTENT -->
        @if($post->type === 'text')
            <p class="text-gray-800 leading-relaxed">
                {{ $post->content }}
            </p>
        @endif

        <!-- IMAGE -->
        @if($post->type === 'image')
            <div class="mt-4 space-y-3">
                @foreach ($post->images as $img)
                    <img src="{{ asset('storage/'.$img->file_path) }}"
                         class="rounded-lg border">
                @endforeach
            </div>
        @endif

        <!-- LINK -->
        @if($post->type === 'link')
            <a href="{{ $post->url }}" target="_blank"
               class="text-orange-600 underline">
                {{ $post->url }}
            </a>
        @endif

        <!-- FOOTER -->
        <div class="flex items-center gap-6 text-sm text-gray-500 mt-6">
            <span>👁 {{ $post->views }}</span>
            <span>💬 {{ $post->comments->count() }}</span>
        </div>

    </div>

    <!-- COMMENTS -->
    <div class="mt-6 space-y-4">
        <h2 class="font-semibold text-lg">Komentar</h2>

        @forelse ($post->comments as $comment)
            <div class="bg-white border rounded-lg p-4">
                <p class="font-semibold text-sm">
                    {{ $comment->user->name }}
                </p>
                <p class="text-gray-700">
                    {{ $comment->content }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">Belum ada komentar</p>
        @endforelse
    </div>

</div>
