<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Search</h1>

    <input
        type="text"
        wire:model.debounce.500ms="query"
        placeholder="Cari post..."
        class="w-full px-4 py-2 border rounded mb-6">

    @if($query && $posts->isEmpty())
    <p class="text-gray-500">Tidak ada hasil.</p>
    @endif

    @foreach($posts as $post)
    <div class="border rounded p-4 mb-4">
        <h2 class="font-semibold text-lg">{{ $post->title }}</h2>
        <p class="text-gray-600 text-sm">
            {{ Str::limit($post->content, 120) }}
        </p>
    </div>
    @endforeach
</div>