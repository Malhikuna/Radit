<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white rounded-lg border mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 bg-gradient-to-r from-[#3e2b2c] to-[#3e2b2c]"></div>

        <div class="p-6 flex items-center gap-4">

            {{-- ICON --}}
            <div
                class="w-16 h-16 rounded-full bg-[#9966CC] border-[#7A49A6] text-white
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
                   class="px-4 py-2 rounded-full bg-[#9966CC]
                          text-white font-semibold hover:bg-[#7A49A6]">
                    + Create Post
                </a>

                <button
                    class="px-4 py-2 rounded-full border border-[#4480e7]
                           text-white font-semibold hover:bg-[#4480e7] bg-[#6395ee]">
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
