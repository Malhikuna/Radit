<div class="max-w-3xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Communities</h1>

    @if (session()->has('success'))
    <div class="mb-4 text-green-600">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Name</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($communities as $community)
            <tr class="border-t">
                <td class="p-2">{{ $community->name }}</td>
                <td class="p-2 text-center flex gap-3 justify-center">
                    <a href="{{ route('communities.edit', $community->id) }}"
                        class="text-blue-500 hover:underline">
                        Edit
                    </a>

                    <button
                        wire:click="delete({{ $community->id }})"
                        onclick="confirm('Yakin hapus community ini?') || event.stopImmediatePropagation()"
                        class="text-red-500 hover:underline">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>