<div class="max-w-6xl mx-auto py-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex items-center gap-4 mb-6">
        <div
            class="w-16 h-16 rounded-full bg-purple-500
                    flex items-center justify-center
                    text-white font-bold text-xl relative">
            <button class="flex items-center justify-center cursor-pointer absolute h-7 w-7 rounded-full -bottom-0.5 -right-1 bg-gray-400 hover:bg-gray-300 transition">
                <x-lucide-image class="w-4"/>
            </button>
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
                        <livewire:post.post-list :user-id="$user->id" />
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
                    You haven't commented yet
                </div>
            @endif
        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</div>
