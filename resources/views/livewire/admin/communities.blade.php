<div class="space-y-6">
    <h1 class="text-2xl font-bold text-[#7A49A6]">Communities</h1>

    @if($communities->count())
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#9966CC]/10 text-[#7A49A6]">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($communities as $community)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $community->id }}</td>
                                <td class="px-4 py-3 font-medium">{{ $community->name }}</td>
                                <td class="px-4 py-3 max-w-sm truncate">
                                    {{ $community->description }}
                                </td>
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $community->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-gray-500">Tidak ada komunitas.</p>
    @endif
</div>
