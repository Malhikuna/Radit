{{-- <div class="border rounded p-3 bg-gray-50">
    <div class="font-medium mb-2">{{ $post->title }}</div>

    @php
        $userVote = auth()->check()
            ? \App\Models\PollVote::where('user_id', auth()->id())
                ->whereIn('poll_option_id', $post->pollOptions->pluck('id'))
                ->first()
            : null;
    @endphp

    <div class="space-y-1">
        @foreach ($post->pollOptions as $option)
            @php
                $votes = $option->votes()->count();
                $isVoted = $userVote?->poll_option_id === $option->id;
            @endphp

            <button
                wire:click="vote({{ $option->id }})"
                class="w-full flex justify-between px-3 py-2 rounded border
                    {{ $isVoted ? 'bg-blue-100 border-blue-400' : 'bg-white hover:bg-gray-100' }}"
            >
                <span>{{ $option->option_text }}</span>
                <span class="text-xs text-gray-500">{{ $votes }}</span>
            </button>
        @endforeach
    </div>
</div> --}}

<div>
    @php
        $userVote = auth()->check()
            ? \App\Models\PollVote::whereHas('pollOption', function ($q) use ($post) {
                $q->where('post_id', $post->id);
            })->where('user_id', auth()->id())->first()
            : null;

        $totalVotes = $post->pollOptions->sum(fn ($o) => $o->votes()->count());
        $totalVotes = max($totalVotes, 1);
    @endphp

    <div class="border border-gray-200 rounded-lg p-3 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 mb-3 space-y-2">

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
                        ? 'border-blue-500 bg-blue-900/40'
                        : 'border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-800/70' }}"
            >
                {{-- Progress bar --}}
                <div
                    class="absolute inset-y-0 left-0 bg-blue-200 dark:bg-blue-600/30 transition-all duration-300"
                    style="width: {{ $percentage }}%;"
                ></div>

                {{-- Content --}}
                <div class="relative z-10 flex justify-between items-center px-3 py-2">
                    <span class="font-medium text-gray-800 dark:text-gray-200">
                        {{ $option->option_text }}
                    </span>

                    <span class="text-xs text-gray-600 dark:text-gray-200 whitespace-nowrap">
                        {{ $percentage }}% · {{ $votesCount }} vote
                    </span>
                </div>
            </button>
        @endforeach

        {{-- Info --}}
        @auth
            <p class="text-xs text-gray-500 mt-2 dark:text-gray-200">
                Klik pilihan yang sama untuk membatalkan vote
            </p>
        @else
            <p class="text-xs text-gray-400 mt-2 italic dark:text-gray-200">
                Login untuk ikut voting
            </p>
        @endauth

    </div>
</div>
