@php
    $isCommunityPage = request()->routeIs('communities.show');
@endphp

<div 
    class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-900 mb-4 dark:hover:bg-gray-900/80 transition duration-150 cursor-pointer"
    onclick="window.location='{{ route('posts.show', $post) }}'"
>

    {{-- CONTENT COLUMN --}}
    <div class="flex-1 p-4 flex flex-col">

        {{-- AUTHOR INFO + AVATAR --}}
        <div class="flex items-center gap-2 mb-1">
            {{-- Avatar --}}
            <div>
                @if ($post->user->avatar)
                    <img
                        src="{{ asset('storage/' . $post->user->avatar) }}"
                        style="width: 32px; height: 32px"
                        class="rounded-full object-cover border-2 border-yellow-400"
                    >
                @else
                    <div
                        style="width: 32px; height: 32px"
                        class="rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold border-2 border-yellow-400"
                    >
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            {{-- Author Info --}}
            <div class="text-xs text-gray-500">
                @if($isCommunityPage)
                    {{-- Community Show: user --}}
                    <span class="font-medium text-gray-700">u/{{ $post->user->name }}</span>
                @else
                    {{-- Post List: only community --}}
                    <a href="{{ route('communities.show', $post->community->id) }}" class="font-medium text-gray-700 dark:text-white hover:underline">
                        r/{{ $post->community->name }}
                    </a>
                @endif
                <span class="dark:text-gray-400">• {{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        {{-- TITLE --}}
        <a href="{{ route('posts.show', $post->id) }}">
            <h2 class="font-semibold text-lg leading-snug mb-1 transition duration-150 dark:text-white">
                {{ $post->title }}
            </h2>
        </a>

        {{-- LINK --}}
        @if ($post->type === 'link' && $post->url)
            <div class="mb-2">
                <a href="{{ $post->url }}" target="_blank" class="text-blue-600 hover:underline break-all">
                    {{ $post->url }}
                </a>
            </div>
        @endif

        {{-- CONTENT --}}
        {{-- CONTENT (Trix styled) --}}
        @if ($post->content)
            <div class="trix-content text-sm text-gray-800 mb-3 line-clamp-4 dark:text-gray-100">
                {!! $post->content !!}
            </div>
        @endif

        {{-- IMAGE --}}
        @if ($post->type === 'image' && $post->images && $post->images->count())
            <img 
                src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                class="rounded-lg max-h-105 w-full object-cover mb-3"
                alt="post image">
        @endif

        {{-- VIDEO --}}
        @if ($post->type === 'video' && $post->images && $post->images->count())
            <video controls class="rounded-lg max-h-105 w-full mb-3">
                <source src="{{ asset('storage/'.$post->images->first()->file_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif

        {{-- POLL --}}
        @if ($post->type === 'poll' && $post->pollOptions && $post->pollOptions->count())
            <div class="mb-3 border rounded-md p-3 bg-gray-50">
                <div class="font-medium mb-2">{{ $post->title }}</div>
                <ul class="space-y-1">
                    @foreach ($post->pollOptions as $option)
                        <li class="flex justify-between items-center">
                            <span>{{ $option->option_text }}</span>
                            <span class="text-gray-500 text-xs">{{ $option->votes }} votes</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FOOTER / ACTIONS --}}
        <div class="flex items-center gap-4 text-sm text-gray-500 mt-auto">

            {{-- Vote --}}
            <div class="flex items-center gap-1 select-none justify-center px-2 py-2 rounded-full bg-gray-100 dark:bg-gray-700">
                <livewire:components.vote :post="$post" :key="'vote-'.$post->id" />
            </div>

            {{-- Comments --}}
            <a 
                href="{{ route('posts.show', $post) }}"
                class="flex items-center justify-center px-2 py-2 rounded-full bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 "
            >
                <div class="flex items-center gap-1 cursor-pointer">
                    <x-heroicon-s-chat-bubble-bottom-center class="w-4 h-4" />
                    {{ $post->comments_count ?? 0 }} Comments
                </div>
            </a>

            {{-- Share --}}
            <div class="flex items-center gap-1 hover:text-gray-700 cursor-pointer relative" x-data="{ open: false }">
                <div class="flex items-center gap-1 select-none justify-center px-2 py-2 rounded-full bg-gray-100 dark:bg-gray-700 dark:text-gray-200"">
                    <x-heroicon-s-share class="w-4 h-4" />
    
                    <span @click="open = !open">Share</span>
                </div>

                @php
                    $postUrl = route('posts.show', $post->id);
                @endphp


                <div 
                    x-show="open" @click.away="open = false"
                    class="flex flex-col absolute z-10 mt-1 bg-white shadow-lg rounded-md text-md">

                    <a 
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($postUrl) }}"
                        target="_blank"
                        class="flex items-center gap-2 hover:bg-gray-100 px-2 py-3 rounded">
                        <x-lucide-facebook class="w-4 h-4 text-blue-600" />
                        Facebook
                    </a>

                    <a 
                        href="href="https://twitter.com/intent/tweet?url={{ urlencode($postUrl) }}&text={{ urlencode($post->title) }}"
                        target="_blank"
                        class="flex items-center gap-2 hover:bg-gray-100 px-2 py-3 rounded">
                        <x-lucide-twitter class="w-4 h-4 text-sky-500" />
                        Twitter
                    </a>

                    <a 
                        href="https://wa.me/?text={{ urlencode($postUrl) }}"
                        target="_blank"
                        class="flex items-center gap-2 hover:bg-gray-100 px-2 py-3 rounded">
                        <x-lucide-message-circle class="w-4 h-4 text-green-500" />
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>