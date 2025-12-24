<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white rounded-lg border border-gray-200 mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 bg-gradient-to-r from-orange-500 to-orange-400"></div>

        <div class="p-6 flex items-center gap-4">

            {{-- ICON --}}
            <div
                class="w-16 h-16 rounded-full bg-orange-500 text-white
                       flex items-center justify-center text-2xl font-bold">
                {{ strtoupper(substr($community->name, 0, 1)) }}
            </div>

            {{-- TITLE --}}
            <div>
                <h1 class="text-2xl font-bold">
                    c/{{ $community->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $community->members_count }} members
                </p>
            </div>

            {{-- ACTIONS --}}
            <div class="ml-auto flex items-center gap-3">
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 rounded-full bg-orange-500
                          text-white font-semibold hover:bg-orange-600">
                    + Create Post
                </a>

                <button
                    class="px-4 py-2 rounded-full border border-orange-500
                           text-orange-500 font-semibold hover:bg-orange-50">
                    Join
                </button>
            </div>

        </div>
    </div>

    {{-- POST FEED (FULL WIDTH) --}}
    <div class="space-y-6">

        @forelse ($posts as $post)
            <div class="bg-white p-6 rounded-xl shadow-sm border">

                {{-- AUTHOR --}}
                <div class="flex items-center gap-3 mb-3">
                    <img
                        src="{{ $post->user->avatar
                            ? asset('storage/' . $post->user->avatar)
                            : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                        class="w-10 h-10 rounded-full object-cover border"
                    />

                    <div>
                        <p class="font-semibold">
                            {{ $post->user->name }}
                            <span
                                class="ml-1 text-xs bg-blue-500
                                       text-white px-2 py-0.5 rounded">
                                Follow
                            </span>
                        </p>
                        <span class="text-xs text-gray-500">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                {{-- TITLE --}}
                <h2 class="font-bold text-lg mb-2">
                    {{ $post->title }}
                </h2>

                {{-- CONTENT --}}
                @if ($post->content)
                    <p class="text-sm text-gray-700 mb-4">
                        {{ $post->content }}
                    </p>
                @endif

                {{-- IMAGE --}}
                @if ($post->images && $post->images->count())
                    <img
                        src="{{ asset('storage/' . $post->images->first()->file_path) }}"
                        class="rounded-xl w-full mb-4"
                        alt="post image">
                @endif

                {{-- VOTE & COMMENTS --}}
                <div class="flex items-center gap-4 text-gray-700 mt-2">

                    @php
                        $userVote = $post->votes
                            ->where('user_id', auth()->id())
                            ->first();
                    @endphp

                    {{-- LIKE --}}
                    <button
                        wire:click="vote({{ $post->id }}, 1)"
                        class="px-2 py-1 rounded flex items-center gap-1 transition
                        {{ $userVote && $userVote->value == 1
                            ? 'bg-green-400 text-white'
                            : 'bg-green-200 hover:bg-green-300' }}">
                        👍 {{ $post->votes->where('value', 1)->count() }}
                    </button>

                    {{-- DISLIKE --}}
                    <button
                        wire:click="vote({{ $post->id }}, -1)"
                        class="px-2 py-1 rounded flex items-center gap-1 transition
                        {{ $userVote && $userVote->value == -1
                            ? 'bg-red-400 text-white'
                            : 'bg-red-200 hover:bg-red-300' }}">
                        👎 {{ $post->votes->where('value', -1)->count() }}
                    </button>

                    {{-- COMMENTS --}}
                    <div class="flex items-center gap-1">
                        💬 {{ $post->comments_count ?? 0 }}
                    </div>
                </div>

            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center text-gray-500">
                Belum ada post di community ini
            </div>
        @endforelse

    </div>

</div>
