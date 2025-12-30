<div class="border rounded p-3 bg-gray-50">
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
</div>
