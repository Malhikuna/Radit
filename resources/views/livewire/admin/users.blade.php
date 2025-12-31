<div class="p-6">
    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-[#7A49A6]">Users</h1>

        @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">{{ $isEdit ? 'Edit User' : 'Tambah User Baru' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#7A49A6] focus:ring-[#7A49A6]">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#7A49A6] focus:ring-[#7A49A6]">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password {{ $isEdit ? '(Kosongkan jika tidak ganti)' : '' }}</label>
                    <input type="password" wire:model="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#7A49A6] focus:ring-[#7A49A6]">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select wire:model="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#7A49A6] focus:ring-[#7A49A6]">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                    @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button wire:click="{{ $isEdit ? 'update' : 'store' }}" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-[#653d8a]">
                    {{ $isEdit ? 'Update User' : 'Simpan User' }}
                </button>
                @if($isEdit)
                <button wire:click="resetForm" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500">Batal</button>
                @endif
            </div>
        </div>

        <div class="flex items-center">
            <input type="text" wire:model.live="search" placeholder="Cari nama user..." class="w-full md:w-1/3 border-gray-300 rounded-md shadow-sm focus:border-[#7A49A6] focus:ring-[#7A49A6]">
        </div>

        @if($users->count())
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#9966CC]/10 text-[#7A49A6]">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Created At</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs bg-[#9966CC]/20 text-[#7A49A6]">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ $user->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button wire:click="edit({{ $user->id }})" class="text-blue-600 hover:underline mx-2 font-medium">Edit</button>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Yakin ingin menghapus?" class="text-red-600 hover:underline mx-2 font-medium">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">
                {{ $users->links() }}
            </div>
        </div>
        @else
        <div class="bg-white p-10 rounded-xl text-center shadow-sm">
            <p class="text-gray-500 italic">Tidak ada user ditemukan.</p>
        </div>
        @endif
    </div>
</div>