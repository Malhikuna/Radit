@php
    $isCommunityPage = request()->routeIs('communities.show');
@endphp

<div class="w-full mx-auto py-4">

    {{-- POST CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 hover:border-gray-300 transition duration-150">

        <div class="p-4 flex flex-col">

            {{-- AUTHOR INFO + AVATAR --}}
            <div class="flex items-center gap-2 mb-2">
                {{-- Avatar --}}
                <div>
                    @if ($post->user->avatar)
                        <img
                            src="{{ asset('storage/' . $post->user->avatar) }}"
                            class="w-8 h-8 rounded-full object-cover border-2 border-yellow-400"
                        >
                    @else
                        <div
                            class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold border-2 border-yellow-400"
                        >
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                {{-- Author Info --}}
                <div class="text-xs text-gray-500">
                    @if($isCommunityPage)
                        {{-- Community Show: user + community --}}
                        <span class="font-medium text-gray-700">u/{{ $post->user->name }}</span>
                        <span class="text-gray-400">in</span>
                        <a href="{{ route('communities.show', $post->community->id) }}" class="font-medium text-gray-700 hover:underline">
                            r/{{ $post->community->name }}
                        </a>
                    @else
                        {{-- Post List: only community --}}
                        <a href="{{ route('communities.show', $post->community->id) }}" class="font-medium text-gray-700 hover:underline">
                            r/{{ $post->community->name }}
                        </a>
                    @endif
                    • {{ $post->created_at->diffForHumans() }}
                </div>
            </div>

            {{-- TITLE --}}
            <h1 class="font-bold text-2xl leading-snug mb-3">
                {{ $post->title }}
            </h1>

            {{-- LINK --}}
            @if ($post->type === 'link' && $post->url)
                <div class="mb-3">
                    <a
                        href="{{ $post->url }}"
                        target="_blank"
                        class="text-blue-600 hover:underline break-all"
                    >
                        {{ $post->url }}
                    </a>
                </div>
            @endif

            {{-- CONTENT --}}
            @if ($post->content)
                <div class="text-gray-800 mb-4 leading-relaxed whitespace-pre-line">
                    {!! \Illuminate\Support\Str::of($post->content)
                        ->replaceMatches(
                            '/(https?:\/\/[^\s]+)/',
                            '<a href="$1" target="_blank" class="text-blue-600 hover:underline">$1</a>'
                        ) !!}
                </div>
            @endif

            {{-- IMAGE --}}
            @if ($post->type === 'image' && $post->images->count())
                <img
                    src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                    class="rounded-lg max-h-[520px] w-full object-contain mb-4"
                >
            @endif

            {{-- VIDEO --}}
            @if ($post->type === 'video' && $post->images->count())
                <video controls class="rounded-lg max-h-[520px] w-full mb-4">
                    <source
                        src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                        type="video/mp4"
                    >
                </video>
            @endif

            
{{-- POLL --}}
@if ($post->type === 'poll' && $post->pollOptions->count())
    <div class="mb-3 border rounded-md p-3 bg-gray-50">
        <div class="font-medium mb-2">
            {{ $post->title }}
        </div>

        <div class="space-y-2">
            @foreach ($post->pollOptions as $option)
                <button
                    wire:click="$parent.votePoll({{ $option->id }})"
                    onclick="event.stopPropagation()"
                    class="w-full flex justify-between items-center px-3 py-2 rounded border
                           bg-white hover:bg-gray-100 text-left transition"
                >
                    <span>{{ $option->option_text }}</span>

                    <span class="text-xs text-gray-500">
                        {{ $option->votes }} vote
                    </span>
                </button>
            @endforeach
        </div>

        <p class="text-xs text-gray-500 mt-2">
            Klik salah satu pilihan untuk menambah vote
        </p>
    </div>
@endif


            {{-- FOOTER / ACTIONS --}}
            <div class="flex items-center gap-5 text-sm text-gray-500 border-t border-gray-200 pt-3">

                {{-- Vote --}}
                <div class="flex items-center justify-center px-2 py-2 rounded-full bg-gray-100 hover:bg-gray-100/70">
                    <livewire:components.vote
                        :post="$post"
                        :key="'vote-'.$post->id"
                    />
                </div>

                {{-- Comments --}}
                <div class="cursor-pointer flex items-center gap-1 justify-center px-2 py-2 rounded-full bg-gray-100 hover:bg-gray-100/70">
                    <x-heroicon-s-chat-bubble-bottom-center class="w-4 h-4" />
                    {{ $post->comments_count }} Comments
                </div>

                {{-- Views --}}
                <div class="flex items-center gap-1 justify-center px-2 py-2 rounded-full bg-gray-100">
                    <x-lucide-eye class="w-5"/> {{ $post->views }}
                </div>

                {{-- Delete --}}
                @auth
                    @if (auth()->id() === $post->user_id)
                        <button
                            wire:click="deletePost"
                            onclick="confirm('Yakin hapus post ini?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline ml-auto"
                        >
                            Hapus
                        </button>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- ADS --}}
    @ads
        <x-ad-banner />
    @endads

    {{-- COMMENT SECTION --}}
    <livewire:comments.comment-section :post="$post" />

</div>
