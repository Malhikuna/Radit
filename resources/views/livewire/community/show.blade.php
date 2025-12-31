<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white dark:bg-gray-900 dark:border-gray-800 rounded-lg border border-gray-200 mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 w-full relative overflow-hidden bg-gray-200">
            @if($community->banner_image)
                <img src="{{ asset('storage/' . $community->banner_image) }}" 
                    alt="Banner" 
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-linear-to-r from-[#3e2b2c] to-[#3e2b2c]"></div>
            @endif
        </div>

        <div class="p-6 flex items-center justify-between flex-wrap gap-4">

            {{-- LEFT: ICON + NAME --}}
            <div class="flex items-center gap-4">
                {{-- ICON --}}
                <div class="w-16 h-16 rounded-full border border-[#7A49A6] overflow-hidden bg-[#9966CC] flex items-center justify-center shrink-0">
                    @if($community->profile_image)
                        <img src="{{ asset('storage/' . $community->profile_image) }}" 
                            alt="{{ $community->name }}" 
                            class="w-full h-full object-cover">
                    @else
                        <span class="text-white text-2xl font-bold">
                            {{ strtoupper(substr($community->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                {{-- NAME + MEMBER COUNT --}}
                <div class="flex flex-col">
                    <h1 class="text-2xl dark:text-gray-200 font-bold">r/{{ $community->name }}</h1>
                </div>
            </div>

            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $community->members_count ?? 0 }} members</span>

            {{-- ACTIONS --}}
            <div class="ml-auto flex items-center gap-3">
                <a 
                    href="{{ route('posts.create', ['community' => $community->id]) }}"
                    class="px-4 py-2 rounded-full bg-[#9966CC] text-white font-semibold hover:bg-[#7A49A6]">
                    + Create Post
                </a>

        <button 
            wire:click="toggleJoin"
            class="px-4 py-2 rounded-full font-semibold 
                @if($joined)
                    bg-gray-400 border-gray-500 text-white cursor-not-allowed
                @else
                    bg-[#6395ee] border border-[#4480e7] text-white hover:bg-[#4480e7]
                @endif">
            {{ $joined ? 'Joined' : 'Join' }}
        </button>


            </div>

        </div>
    </div>

    {{-- POST FEED --}}
    <div class="space-y-6">
        <livewire:post.post-list :community-id="$community->id" />
    </div>
</div>