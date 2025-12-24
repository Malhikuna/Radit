<div class="max-w-6xl mx-auto mt-6 px-4">
    <div class="grid grid-cols-12 gap-6">

        {{-- ================= LEFT CONTENT ================= --}}
        <div class="col-span-12 md:col-span-8">

            {{-- USER HEADER --}}
            <div class="bg-white border rounded-lg mb-4 overflow-hidden">
                <div class="h-24 bg-purple-500"></div>

                <div class="p-4 flex items-start gap-4">
                    {{-- AVATAR --}}
                    <div class="-mt-12">
                        @if ($user->avatar)
                            <img
                                src="{{ asset('storage/'.$user->avatar) }}"
                                class="w-24 h-24 rounded-full border-4 border-white object-cover"
                            >
                        @else
                            <div
                                class="w-24 h-24 rounded-full bg-blue-600 text-white
                                       flex items-center justify-center text-3xl font-bold
                                       border-4 border-white">
                                {{ strtoupper(substr($user->name,0,1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- USER INFO --}}
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold">
                            {{ $user->name }}
                        </h1>
                        <p class="text-sm text-gray-500">
                            u/{{ $user->username ?? 'user'.$user->id }}
                        </p>
                    </div>

                    {{-- ACTION --}}
                    <a href="{{ route('posts.create') }}"
                       class="px-4 py-1.5 text-sm font-semibold
                              border border-blue-600 text-blue-600
                              rounded-full hover:bg-blue-50">
                        Create Post
                    </a>
                </div>
            </div>

            {{-- ================= TABS ================= --}}
            <div x-data="{ tab: 'posts' }" class="bg-white border rounded-lg">

                {{-- TAB NAV --}}
                <div class="flex border-b text-sm font-semibold">
                    <button
                        @click="tab='posts'"
                        :class="tab==='posts'
                            ? 'border-b-2 border-blue-600 text-blue-600'
                            : 'text-gray-500'"
                        class="px-4 py-3">
                        Posts
                    </button>

                    <button
                        @click="tab='comments'"
                        :class="tab==='comments'
                            ? 'border-b-2 border-blue-600 text-blue-600'
                            : 'text-gray-500'"
                        class="px-4 py-3">
                        Comments
                    </button>
                </div>

                {{-- ================= POSTS ================= --}}
                <div x-show="tab==='posts'" class="divide-y">
                    @forelse ($posts as $post)
                        @include('components.post-card', ['post' => $post])
                    @empty
                        <div class="p-10 text-center text-gray-500">
                            You haven’t posted yet
                        </div>
                    @endforelse
                </div>

                {{-- ================= COMMENTS ================= --}}
                <div x-show="tab==='comments'" class="divide-y">
                    @forelse ($comments as $comment)
                        <div class="p-4 hover:bg-gray-50">
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
                    @empty
                        <div class="p-10 text-center text-gray-500">
                            You haven’t commented yet
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- ================= RIGHT SIDEBAR ================= --}}
        <div class="col-span-12 md:col-span-4">
            <div class="bg-white border rounded-lg p-4 sticky top-4">

                <h2 class="text-sm font-bold mb-3">
                    About You
                </h2>

                <div class="text-sm text-gray-700 space-y-2">
                    <p>
                        <b>Karma:</b> {{ $karma }}
                    </p>

                    <p>
                        <b>Posts:</b> {{ $posts->count() }}
                    </p>

                    <p>
                        <b>Comments:</b> {{ $comments->count() }}
                    </p>

                    <p class="text-xs text-gray-500 pt-2 border-t">
                        Joined {{ $user->created_at->format('M Y') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
