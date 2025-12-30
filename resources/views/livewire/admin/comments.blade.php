<div class="space-y-6">
    <h1 class="text-2xl font-bold text-[#7A49A6]">Comments</h1>

    @if($comments->count())
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#9966CC]/10 text-[#7A49A6]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Post</th>
                            <th class="px-4 py-3">Content</th>
                            <th class="px-4 py-3">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($comments as $comment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $comment->id }}</td>
                                <td class="px-4 py-3">{{ $comment->user->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $comment->post->title ?? '-' }}</td>
                                <td class="px-4 py-3 max-w-xs truncate">
                                    {{ $comment->content }}
                                </td>
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $comment->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-gray-500">Tidak ada komentar.</p>
    @endif
</div>
