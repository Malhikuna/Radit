<div class="bg-white p-6 rounded-xl shadow-sm border mb-6">

    <!-- AUTHOR -->
    <div class="flex items-center gap-3 mb-3">
        <img
            src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
            class="w-10 h-10 rounded-full object-cover border"
        />
        <div>
            <p class="font-semibold">
                {{ $post->user->name }}
                <span class="ml-1 text-xs bg-blue-500 text-white px-2 py-0.5 rounded">
                    Follow
                </span>
            </p>
            <span class="text-xs text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </span>
        </div>
    </div>

    <!-- TITLE -->
    <h2 class="font-bold text-lg mb-2">
        {{ $post->title }}
    </h2>

    <!-- CONTENT -->
    @if ($post->content)
        <p class="text-sm text-gray-700 mb-4">{{ $post->content }}</p>
    @endif

    <!-- IMAGE -->
    @if($post->images && $post->images->count())
        <img src="{{ asset('storage/' . $post->images->first()->file_path) }}"
             class="rounded-xl w-full mb-4"
             alt="post image">
    @endif

<!-- VOTE & COMMENTS -->
<div class="flex items-center gap-4 text-gray-700 mt-2">

    @php
        // Ambil vote user saat ini
        $userVote = $post->votes->where('user_id', auth()->id())->first();
    @endphp

    <!-- LIKE -->
    <button wire:click="vote({{ $post->id }}, 1)" 
            class="px-2 py-1 rounded flex items-center gap-1 transition
            {{ $userVote && $userVote->value == 1 ? 'bg-green-400 text-white' : 'bg-green-200 hover:bg-green-300' }}">
        👍 {{ $post->likes_count }}
    </button>

    <!-- DISLIKE -->
    <button wire:click="vote({{ $post->id }}, -1)" 
            class="px-2 py-1 rounded flex items-center gap-1 transition
            {{ $userVote && $userVote->value == -1 ? 'bg-red-400 text-white' : 'bg-red-200 hover:bg-red-300' }}">
        👎 {{ $post->dislikes_count }}
    </button>

    <!-- COMMENTS -->
    <div class="flex items-center gap-1">💬 {{ $post->comments_count ?? 0 }}</div>
</div>

</div>
