<div>
    <h1 class="text-3xl font-bold mb-6">Users</h1>

    @if($users->count())
        <table class="w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $user->id }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">{{ $user->role }}</td>
                        <td class="p-2 border">{{ $user->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada user.</p>
    @endif
</div>
