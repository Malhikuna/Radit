<div class="bg-white rounded-xl border border-gray-200 mb-4 hover:border-gray-300 transition duration-150 cursor-pointer">

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
                <span class="font-medium text-gray-700">u/{{ $post->user->name }}</span>
                • {{ $post->created_at->diffForHumans() }}
            </div>
        </div>

        {{-- TITLE --}}
        <a href="{{ route('posts.show', $post->id) }}">
            <h2 class="font-bold text-lg leading-snug mb-1 transition duration-150">
                {{ $post->title }}
            </h2>
        </a>

        {{-- LINK (jika post type link) --}}
        @if ($post->type === 'link' && $post->url)
            <div class="mb-2">
                <a href="{{ $post->url }}" target="_blank" class="text-blue-600 hover:underline break-all">
                    {{ $post->url }}
                </a>
            </div>
        @endif

        {{-- CONTENT (URL otomatis clickable) --}}
        @if ($post->content)
            <p class="text-sm text-gray-800 mb-3 line-clamp-4">
                {!! \Illuminate\Support\Str::of($post->content)
                    ->replaceMatches('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" class="text-blue-600 hover:underline">$1</a>') !!}
            </p>
        @endif

        {{-- IMAGE --}}
        @if ($post->type === 'image' && $post->images && $post->images->count())
            <img 
                src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                class="rounded-lg max-h-[420px] w-full object-cover mb-3"
                alt="post image">
        @endif

        {{-- VIDEO --}}
        @if ($post->type === 'video' && $post->images && $post->images->count())
            <video controls class="rounded-lg max-h-[420px] w-full mb-3">
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

            {{-- Vote (Like/Dislike) --}}
            <div class="flex items-center gap-1 select-none">
                <livewire:components.vote :post="$post" :key="'vote-'.$post->id" />
            </div>

            {{-- Comments --}}
            <a href="{{ route('posts.show', $post) }}">
                <div class="flex items-center gap-1 hover:text-gray-700 cursor-pointer">
                    <x-heroicon-s-chat-bubble-bottom-center class="w-4 h-4" />
                    {{ $post->comments_count ?? 0 }} Comments
                </div>
            </a>

            {{-- Share --}}
            <div class="flex items-center gap-1 hover:text-gray-700 cursor-pointer relative" x-data="{ open: false }">
                <x-heroicon-s-share class="w-4 h-4" />
                <span @click="open = !open">Share</span>

                <div 
                    x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-1 bg-white border shadow-lg rounded-md p-2 text-xs">
                    <a 
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="block hover:bg-gray-100 px-2 py-1 rounded">
                        Facebook
                    </a>
                    <a 
                        href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="block hover:bg-gray-100 px-2 py-1 rounded">
                        Twitter
                    </a>
                    <a 
                        href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" class="block hover:bg-gray-100 px-2 py-1 rounded">
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
