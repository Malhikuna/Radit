<div class="space-y-6">
    <h1 class="text-2xl font-bold text-[#7A49A6]">Posts</h1>

    @if($posts->count())
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#9966CC]/10 text-[#7A49A6]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Community</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $post->id }}</td>
                                <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                                <td class="px-4 py-3">{{ $post->user->name }}</td>
                                <td class="px-4 py-3">{{ $post->community->name }}</td>
                                <td class="px-4 py-3">{{ $post->type }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs
                                        bg-green-100 text-green-700">
                                        {{ $post->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $post->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-gray-500">Tidak ada postingan.</p>
    @endif
</div>
