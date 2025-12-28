<div>
    <h1 class="text-3xl font-bold mb-6">Posts</h1>

    @if($posts->count())
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">User</th>
                    <th class="p-2 border">Community</th>
                    <th class="p-2 border">Type</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $post->id }}</td>
                        <td class="p-2 border">{{ $post->title }}</td>
                        <td class="p-2 border">{{ $post->user->name }}</td>
                        <td class="p-2 border">{{ $post->community->name }}</td>
                        <td class="p-2 border">{{ $post->type }}</td>
                        <td class="p-2 border">{{ $post->status }}</td>
                        <td class="p-2 border">{{ $post->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada postingan.</p>
    @endif
</div>
