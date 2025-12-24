<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex items-center gap-4 mb-6">
        <div
            class="w-16 h-16 rounded-full bg-purple-500
                   flex items-center justify-center
                   text-white font-bold text-xl">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
            <p class="text-sm text-gray-500">
                u/{{ $user->username ?? 'user'.$user->id }}
            </p>
        </div>
    </div>

    {{-- ================= TABS ================= --}}
    <div x-data="{ tab: 'posts' }">

        {{-- TAB NAV --}}
        <div class="flex gap-6 border-b mb-4 text-sm font-semibold">
            <button @click="tab='posts'"
                :class="tab==='posts'
                    ? 'border-b-2 border-black text-black'
                    : 'text-gray-500'"
                class="pb-3">
                Posts
            </button>

            <button @click="tab='comments'"
                :class="tab==='comments'
                    ? 'border-b-2 border-black text-black'
                    : 'text-gray-500'"
                class="pb-3">
                Comments
            </button>
        </div>

        {{-- CREATE POST --}}
        <div class="mb-6">
            <a href="{{ route('posts.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                      border text-sm font-semibold hover:bg-gray-100">
                ➕ Create Post
            </a>
        </div>

        {{-- ================= POSTS ================= --}}
        <div x-show="tab==='posts'">

            @if ($posts->count())
                <div class="space-y-4">

                    @foreach ($posts as $post)
                        {{-- ===== POST CARD ===== --}}
                        <div class="bg-white border rounded-lg p-4 hover:border-gray-300">

                            {{-- AUTHOR --}}
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                                <span class="font-medium text-gray-700">
                                    u/{{ $post->user->name }}
                                </span>
                                • {{ $post->created_at->diffForHumans() }}
                                • r/{{ $post->community->name }}
                            </div>

                            {{-- TITLE --}}
                            <h2 class="font-bold text-lg mb-2">
                                <a href="{{ route('posts.show', $post->id) }}"
                                   class="hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            {{-- CONTENT --}}
                            @if ($post->content)
                                <p class="text-sm text-gray-800 mb-3">
                                    {{ Str::limit($post->content, 180) }}
                                </p>
                            @endif
{{-- CONTENT --}}
@if ($post->content)
    <p class="text-sm text-gray-800 mb-3">
        {{ Str::limit($post->content, 180) }}
    </p>
@endif

{{-- IMAGE --}}
@if ($post->type === 'image' && $post->images->count())
    <img
        src="{{ asset('storage/'.$post->images->first()->file_path) }}"
        class="rounded-lg max-h-[520px] w-full object-contain mb-3">
@endif

{{-- VIDEO --}}
@if ($post->type === 'video' && $post->images->count())
    <video controls class="rounded-lg max-h-[520px] w-full mb-3">
        <source
            src="{{ asset('storage/'.$post->images->first()->file_path) }}"
            type="video/mp4">
    </video>
@endif


                            {{-- FOOTER --}}
                            <div class="flex gap-4 text-xs text-gray-500">
                                <span>💬 {{ $post->comments_count }} comments</span>
                                <span>⬆ {{ $post->votes->sum('value') }}</span>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                {{-- EMPTY --}}
                <div class="flex flex-col items-center py-20 text-center">
                    <h2 class="text-xl font-bold mb-2">
                        You don't have any posts yet
                    </h2>
                    <p class="text-gray-500 mb-6">
                        Once you post to a community, it’ll show up here.
                    </p>
                    <a href="{{ route('posts.create') }}"
                       class="px-6 py-2 bg-blue-600 text-white rounded-full
                              text-sm font-semibold hover:bg-blue-700">
                        Create Your First Post
                    </a>
                </div>
            @endif
        </div>

        {{-- ================= COMMENTS ================= --}}
        <div x-show="tab==='comments'">
            @if ($comments->count())
                <div class="divide-y">
                    @foreach ($comments as $comment)
                        <div class="py-4">
                            <p class="text-xs text-gray-500 mb-1">
                                Commented {{ $comment->created_at->diffForHumans() }}
                                on
                                <a href="{{ route('posts.show', $comment->post->id) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $comment->post->title }}
                                </a>
                            </p>
                            <p class="text-sm text-gray-800">
                                {{ $comment->content }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-20 text-center text-gray-500">
                    You haven’t commented yet
                </div>
            @endif
        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</div>
