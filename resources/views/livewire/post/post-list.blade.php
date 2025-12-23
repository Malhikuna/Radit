<div>
    {{-- SORT --}}
    <div class="flex gap-3 mb-4">
        <button wire:click="$set('sort','new')" 
                class="{{ $sort === 'new' ? 'font-bold' : '' }}">
            New
        </button>
        <button wire:click="$set('sort','best')" 
                class="{{ $sort === 'best' ? 'font-bold' : '' }}">
            Best
        </button>
    </div>

    {{-- POSTS LIST --}}
    @foreach ($posts as $post)
<<<<<<< HEAD:resources/views/livewire/post/post-list.blade.php
<<<<<<< HEAD:resources/views/livewire/post/post-list.blade.php
        <div class="bg-white p-6 rounded-xl shadow-sm ring-gray-100 mb-6">

            <!-- AUTHOR -->
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                        class="w-10 h-10 rounded-full object-cover border" />
=======
        <a href="{{ route('posts.show', $post->id) }}"
           class="block">

            <div
                class="bg-white p-6 rounded-xl shadow-sm border mb-6
                       hover:border-orange-400 transition">
>>>>>>> 235d953b77b221caa7e2489c340946dc09ab07f7:resources/views/livewire/components/post-list.blade.php

                {{-- AUTHOR --}}
                <div class="flex items-center gap-3 mb-3">
                    <img
                        src="{{ $post->user->avatar
                            ? asset('storage/' . $post->user->avatar)
                            : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                        class="w-10 h-10 rounded-full object-cover border"
                    />

                    <div>
                        <p class="font-semibold flex items-center gap-2">
                            {{ $post->user->name }}
                            <span
                                class="text-xs bg-blue-500 text-white px-2 py-0.5 rounded">
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

                {{-- ACTIONS --}}
                <div class="flex items-center gap-4 text-sm text-gray-700 mt-3">

                    @php
                        $userVote = $post->votes
                            ->where('user_id', auth()->id())
                            ->first();
                    @endphp

                    {{-- UPVOTE --}}
                    <button
                        wire:click.prevent="vote({{ $post->id }}, 1)"
                        class="flex items-center gap-1 px-2 py-1 rounded-md transition
                        {{ $userVote && $userVote->value == 1
                            ? 'bg-green-500 text-white'
                            : 'bg-green-100 hover:bg-green-200' }}">
                        <x-heroicon-o-hand-thumb-up class="w-4 h-4" />
                        {{ $post->votes->where('value', 1)->count() }}
                    </button>

                    {{-- DOWNVOTE --}}
                    <button
                        wire:click.prevent="vote({{ $post->id }}, -1)"
                        class="flex items-center gap-1 px-2 py-1 rounded-md transition
                        {{ $userVote && $userVote->value == -1
                            ? 'bg-red-500 text-white'
                            : 'bg-red-100 hover:bg-red-200' }}">
                        <x-heroicon-o-hand-thumb-down class="w-4 h-4" />
                        {{ $post->votes->where('value', -1)->count() }}
                    </button>

                    {{-- COMMENTS --}}
                    <div class="flex items-center gap-1 text-gray-500">
                        <x-heroicon-o-chat-bubble-left class="w-4 h-4" />
                        {{ $post->comments_count ?? 0 }}
                    </div>
                </div>

            </div>
        </a>
=======
        <livewire:components.card
            :post="$post"
            :key="'post-'.$post->id" />
>>>>>>> c87eae3 (feat: crud comment):resources/views/livewire/components/post-list.blade.php
    @endforeach
</div>
