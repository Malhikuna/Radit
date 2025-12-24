<div>
    <h1 class="text-3xl font-bold mb-6">Comments</h1>

    @if($comments->count())
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">User</th>
                    <th class="p-2 border">Post</th>
                    <th class="p-2 border">Content</th>
                    <th class="p-2 border">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $comment->id }}</td>
                        <td class="p-2 border">{{ $comment->user->name ?? 'Unknown' }}</td>
                        <td class="p-2 border">{{ $comment->post->title ?? 'Unknown' }}</td>
                        <td class="p-2 border">{{ $comment->content }}</td>
                        <td class="p-2 border">{{ $comment->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada komentar.</p>
    @endif
</div>
