@php
    $isCommunityPage = request()->routeIs('communities.show');
@endphp

<div
    class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 hover:border-gray-300 transition duration-150"
>

    {{-- CONTENT COLUMN --}}
    <div class="flex-1 p-4 flex flex-col">

        {{-- AUTHOR INFO --}}
        <div class="flex items-center gap-2 mb-1">
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

            <div class="text-xs text-gray-500">
                @if($isCommunityPage)
                    <span class="font-medium text-gray-700">u/{{ $post->user->name }}</span>
                @else
                    <a href="{{ route('communities.show', $post->community->id) }}"
                       class="font-medium text-gray-700 hover:underline">
                        r/{{ $post->community->name }}
                    </a>
                @endif
                • {{ $post->created_at->diffForHumans() }}
            </div>
        </div>

        {{-- TITLE --}}
        <a href="{{ route('posts.show', $post) }}">
            <h2 class="font-semibold text-lg leading-snug mb-1 hover:underline">
                {{ $post->title }}
            </h2>
        </a>

        {{-- LINK --}}
        @if ($post->type === 'link' && $post->url)
            <a href="{{ $post->url }}" target="_blank"
               class="text-blue-600 hover:underline break-all mb-2">
                {{ $post->url }}
            </a>
        @endif

        {{-- CONTENT --}}
        @if ($post->content)
            <p class="text-sm text-gray-800 mb-3 line-clamp-4">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 200) }}
            </p>
        @endif

        {{-- IMAGE --}}
        @if ($post->type === 'image' && $post->images->count())
            <img
                src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                class="rounded-lg max-h-96 w-full object-cover mb-3"
            >
        @endif

        {{-- VIDEO --}}
        @if ($post->type === 'video' && $post->images->count())
            <video controls class="rounded-lg max-h-96 w-full mb-3">
                <source src="{{ asset('storage/'.$post->images->first()->file_path) }}" type="video/mp4">
            </video>
        @endif

{{-- ================= POLL ================= --}}
@if ($post->type === 'poll')

    @php
        $userVote = auth()->check()
            ? \App\Models\PollVote::whereHas('pollOption', function ($q) use ($post) {
                $q->where('post_id', $post->id);
            })->where('user_id', auth()->id())->first()
            : null;

        $totalVotes = $post->pollOptions->sum(fn ($o) => $o->votes()->count());
        $totalVotes = max($totalVotes, 1); // hindari division by zero
    @endphp

    <div class="border rounded-lg p-3 bg-gray-50 mb-3 space-y-2">

        @foreach ($post->pollOptions as $option)
            @php
                $votesCount = $option->votes()->count();
                $percentage = round(($votesCount / $totalVotes) * 100);
                $isSelected = $userVote?->poll_option_id === $option->id;
            @endphp

            <button
                wire:click.stop="votePoll({{ $option->id }})"
                class="w-full text-left relative overflow-hidden rounded-lg border transition
                    {{ $isSelected
                        ? 'border-blue-500 bg-blue-50'
                        : 'border-gray-200 bg-white hover:bg-gray-100' }}"
            >
                {{-- Progress bar --}}
                <div
                    class="absolute inset-y-0 left-0 bg-blue-200 transition-all duration-300"
                    style="width: {{ $percentage }}%;"
                ></div>

                {{-- Content --}}
                <div class="relative z-10 flex justify-between items-center px-3 py-2">
                    <span class="font-medium text-gray-800">
                        {{ $option->option_text }}
                    </span>

                    <span class="text-xs text-gray-600 whitespace-nowrap">
                        {{ $percentage }}% · {{ $votesCount }} vote
                    </span>
                </div>
            </button>
        @endforeach

        {{-- Info --}}
        @auth
            <p class="text-xs text-gray-500 mt-2">
                Klik pilihan yang sama untuk membatalkan vote
            </p>
        @else
            <p class="text-xs text-gray-400 mt-2 italic">
                Login untuk ikut voting
            </p>
        @endauth

    </div>

@endif
{{-- ================= END POLL ================= --}}




        {{-- FOOTER --}}
        <div class="flex items-center gap-4 text-sm text-gray-500 mt-auto">

            {{-- POST VOTE --}}
            <div class="flex items-center px-2 py-2 rounded-full bg-gray-100">
                <livewire:components.vote :post="$post" :key="'vote-'.$post->id" />
            </div>

            {{-- COMMENTS --}}
            <a href="{{ route('posts.show', $post) }}"
               class="flex items-center gap-1 px-2 py-2 rounded-full bg-gray-100 hover:text-gray-700">
                <x-heroicon-s-chat-bubble-bottom-center class="w-4 h-4" />
                {{ $post->comments_count ?? 0 }} Comments
            </a>

            {{-- SHARE --}}
            @php $postUrl = route('posts.show', $post); @endphp

            <div x-data="{ open:false }" class="relative">
                <button @click="open=!open"
                        class="flex items-center gap-1 px-2 py-2 rounded-full bg-gray-100 hover:text-gray-700">
                    <x-heroicon-s-share class="w-4 h-4" />
                    Share
                </button>

                <div x-show="open" @click.away="open=false"
                     class="absolute z-10 mt-1 bg-white shadow-lg rounded-md text-sm w-40">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($postUrl) }}"
                       target="_blank"
                       class="block px-3 py-2 hover:bg-gray-100">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($postUrl) }}&text={{ urlencode($post->title) }}"
                       target="_blank"
                       class="block px-3 py-2 hover:bg-gray-100">
                        Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($postUrl) }}"
                       target="_blank"
                       class="block px-3 py-2 hover:bg-gray-100">
                        WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
