<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white rounded-lg border mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 bg-gradient-to-r from-[#3e2b2c] to-[#3e2b2c]"></div>

        <div class="p-6 flex items-center justify-between flex-wrap gap-4">

            {{-- LEFT: ICON + NAME --}}
            <div class="flex items-center gap-4">
                {{-- ICON --}}
                <div
                    class="w-16 h-16 rounded-full bg-[#9966CC] border border-[#7A49A6] text-white
                           flex items-center justify-center text-2xl font-bold">
                    {{ strtoupper(substr($community->name, 0, 1)) }}
                </div>

                {{-- NAME + MEMBER COUNT --}}
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold">r/{{ $community->name }}</h1>
                </div>
            </div>

            <span class="text-sm text-gray-500">{{ $community->members_count ?? 0 }} members</span>


            {{-- RIGHT: ACTION BUTTONS --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('posts.create', ['community' => $community->id]) }}"
                   class="px-4 py-2 rounded-full bg-[#9966CC] text-white font-semibold hover:bg-[#7A49A6]">
                    + Create Post
                </a>

                {{-- JOIN BUTTON LIVEWIRE --}}
                <livewire:community.join-community :community="$community" />
            </div>

        </div>
    </div>

    {{-- POST FEED --}}
    <div class="space-y-6">
        <livewire:community.post-list :communityId="$community->id" />
    </div>

</div>
