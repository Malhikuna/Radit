<<<<<<< HEAD:resources/views/livewire/community/index.blade.php
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
=======
<div class="max-w-3xl mx-auto space-y-4">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold">Communities</h1>

        <a href="{{ route('communities.create') }}"
           class="px-4 py-1.5 rounded-full bg-orange-500
                  text-white text-sm font-semibold hover:bg-orange-600">
            + Create Community
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if (session()->has('success'))
        <div class="bg-green-50 text-green-700 px-4 py-2 rounded-md text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- COMMUNITY LIST --}}
    <div class="space-y-3">
        @forelse ($communities as $community)
            <div
                class="bg-white border rounded-lg p-4
                       flex items-center gap-4
                       hover:border-gray-400 transition">

                {{-- ICON --}}
                <x-community-icon
                    :community="$community"
                    size="40"
                />

                {{-- INFO --}}
                <div class="flex-1 min-w-0">
                    <h2 class="font-semibold truncate">
                        r/{{ $community->name }}
                    </h2>

                    <p class="text-xs text-gray-500">
                        {{ $community->members_count ?? 0 }} members
                        • Created {{ $community->created_at->diffForHumans() }}
                    </p>
                </div>

                {{-- ACTION --}}
                <div class="flex items-center gap-3 text-sm">
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
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-10">
                Belum ada community
            </div>
        @endforelse
    </div>

>>>>>>> a068ad99591de780c1e9d42585b862f42cb5ba36:resources/views/livewire/pages/community/index.blade.php
</div>
