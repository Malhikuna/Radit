<div class="max-w-3xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold">Communities</h1>
        <a 
            href="{{ route('communities.create') }}"
            class="px-4 py-2 rounded-full bg-purple-500
                   text-white text-sm font-semibold hover:bg-purple-600 transition">
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
    <div class="space-y-4">
        @forelse ($communities as $community)
            <div
                class="bg-white border rounded-lg p-4 flex items-center gap-4 hover:shadow-sm transition">

                {{-- ICON --}}
                <x-community-icon
                    :community="$community"
                    size="40"
                />

                {{-- INFO --}}
                <div class="flex-1 min-w-0">
                    <h2 class="font-semibold truncate text-gray-800">
                        r/{{ $community->name }}
                        @if(auth()->id() === $community->creator_id)
                            <span class="text-xs text-purple-500 ml-1">(You)</span>
                        @endif
                    </h2>

                    <p class="text-xs text-gray-500 truncate">
                        {{ $community->members_count ?? 0 }} {{ Str::plural('member', $community->members_count) }}
                        • Created {{ $community->created_at->diffForHumans() }}
                    </p>
                </div>

                {{-- ACTIONS --}}
                @if(auth()->id() === $community->creator_id)
                    <div class="flex items-center gap-3 text-sm">
                        <a 
                            href="{{ route('communities.edit', $community->id) }}"
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
                @endif

            </div>
        @empty
            <div class="text-center text-gray-500 py-10">
                Belum ada community. 
                <a href="{{ route('communities.create') }}" class="text-purple-500 hover:underline">Buat community baru sekarang!</a>
            </div>
        @endforelse
    </div>
</div>
