<div>
    <h1 class="text-3xl font-bold mb-6">Communities</h1>

    @if($communities->count())
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($communities as $community)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $community->id }}</td>
                        <td class="p-2 border">{{ $community->name }}</td>
                        <td class="p-2 border">{{ $community->description }}</td>
                        <td class="p-2 border">{{ $community->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada komunitas.</p>
    @endif
</div>
