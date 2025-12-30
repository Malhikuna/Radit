@php
    $isCommunityPage = request()->routeIs('communities.show');
@endphp

<div class="w-full mx-auto py-4">

    {{-- POST CARD --}}
    <div class="bg-white dark:bg-gray-900 dark:border-gray-900 rounded-xl shadow-sm border border-gray-100 mb-4 hover:border-gray-900 transition duration-150">

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
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    @if($isCommunityPage)
                        {{-- Community Show: user + community --}}
                        <span class="font-medium text-gray-700">u/{{ $post->user->name }}</span>
                        <span class="text-gray-400">in</span>
                        <a href="{{ route('communities.show', $post->community->id) }}" class="font-medium text-gray-700 hover:underline">
                            r/{{ $post->community->name }}
                        </a>
                    @else
                        {{-- Post List: only community --}}
                        <a href="{{ route('communities.show', $post->community->id) }}" class="font-medium text-gray-700 dark:text-gray-200 hover:underline">
                            r/{{ $post->community->name }}
                        </a>
                    @endif
                    • {{ $post->created_at->diffForHumans() }}
                </div>
            </div>

            {{-- TITLE --}}
            <h1 class="font-bold text-2xl leading-snug mb-3 dark:text-white">
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
                <div class="text-gray-800 dark:text-gray-300 mb-4 leading-relaxed whitespace-pre-line">
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
                    class="rounded-lg max-h-130 w-full object-contain mb-4"
                >
            @endif

            {{-- VIDEO --}}
            @if ($post->type === 'video' && $post->images->count())
                <video controls class="rounded-lg max-h-130 w-full mb-4">
                    <source
                        src="{{ asset('storage/'.$post->images->first()->file_path) }}"
                        type="video/mp4"
                    >
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


            {{-- FOOTER / ACTIONS --}}
            <div class="flex items-center gap-5 text-sm text-gray-500 border-t border-gray-200 dark:border-gray-600 pt-3">

                {{-- Vote --}}
                <div class="flex items-center justify-center px-2 py-2 rounded-full bg-gray-100 hover:bg-gray-100/70 dark:bg-gray-700 dark:hover:bg-gray-600">
                    <livewire:components.vote
                        :post="$post"
                        :key="'vote-'.$post->id"
                    />
                </div>

                {{-- Comments --}}
                <div class="cursor-pointer flex items-center gap-1 justify-center px-2 py-2 rounded-full bg-gray-100 hover:bg-gray-100/70 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                    <x-heroicon-s-chat-bubble-bottom-center class="w-4 h-4" />
                    {{ $post->comments_count }} Comments
                </div>

                {{-- Views --}}
                <div class="flex items-center gap-1 justify-center px-2 py-2 rounded-full bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
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
