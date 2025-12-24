<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white rounded-lg border mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 bg-gradient-to-r from-orange-500 to-orange-400"></div>

        <div class="p-6 flex items-center gap-4">

            {{-- ICON --}}
            <div
                class="w-16 h-16 rounded-full bg-orange-500 text-white
                       flex items-center justify-center text-2xl font-bold">
                {{ strtoupper(substr($community->name, 0, 1)) }}
            </div>

            {{-- TITLE --}}
            <div>
                <h1 class="text-2xl font-bold">
                    r/{{ $community->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $community->members_count }} members
                </p>
            </div>

            {{-- ACTIONS --}}
            <div class="ml-auto flex items-center gap-3">
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 rounded-full bg-orange-500
                          text-white font-semibold hover:bg-orange-600">
                    + Create Post
                </a>

                <button
                    class="px-4 py-2 rounded-full border border-orange-500
                           text-orange-500 font-semibold hover:bg-orange-50">
                    Join
                </button>
            </div>

        </div>
    </div>

    {{-- POST FEED (FULL WIDTH) --}}
    <div class="space-y-6">
        <livewire:community.post-list />
    </div>

</div>
