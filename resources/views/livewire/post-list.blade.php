<div>
    <div class="flex gap-4 mb-4">
        <button wire:click="$set('sort','new')"
            class="px-3 py-1 rounded {{ $sort === 'new' ? 'bg-yellow-300' : 'bg-gray-200' }}">
            🆕 New
        </button>

        <button wire:click="$set('sort','best')"
            class="px-3 py-1 rounded {{ $sort === 'best' ? 'bg-orange-300' : 'bg-gray-200' }}">
            🔥 Best
        </button>
    </div>

    @foreach ($posts as $post)
    @include('components.card', [
    'author' => $post->user->name ?? 'Anon',
    'time' => $post->created_at->diffForHumans(),
    'title' => $post->title,
    'content' => $post->content,
    'likes' => $post->votes_sum_value ?? 0,
    'comments' => $post->comments_count ?? 0,
    ])
    @endforeach
</div>