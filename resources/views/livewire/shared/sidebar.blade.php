<aside
    class="fixed top-15 left-0 w-64 h-[calc(100vh)] bg-white border-r border-gray-200 px-4 py-6 overflow-y-auto z-40 text-sm overflow-y-auto scrollbar-hide">

    {{-- MAIN NAV --}}
    <div class="space-y-1">
        <a 
            href="{{ route('home') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-medium 
                        {{ 
                            request()->routeIs('home') && !request()->has('sort')
                            ? 'bg-[#9966CC] text-white'
                            : 'text-black hover:bg-gray-100 hover:text-[#7A49A6]' 
                        }}"
        >
            <x-heroicon-o-home class="w-5 h-5" />
            <span>Home</span>
        </a>

        <a 
            href="{{ route('home', ['sort' => 'popular']) }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-medium
                    {{ 
                        request('sort') === 'popular'
                        ? 'bg-[#9966CC] text-white'
                        : 'text-black hover:bg-gray-100 hover:text-[#7A49A6]' 
                    }}"
        >
            <x-heroicon-o-fire class="w-5 h-5" />
            <span>Popular</span>
        </a>
    </div>

    <div class="border-b my-5 border-black/10 w-full"></div>

    {{-- FOLLOWING COMMUNITIES --}}
    @auth
        <div>
            <h3 class="px-3 mb-2 text-xs font-semibold uppercase text-gray-500">
                Following Communities
            </h3>

            <ul class="space-y-1">
                @forelse ($followingCommunities as $community)
                    <li>
                        <a href="{{ route('communities.show', $community) }}"
                            class="flex items-center gap-3 px-3 py-1.5 rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-[#3e2b2c]"
                        >

                            <x-community-icon :community="$community" size="26" />

                            <span class="truncate">
                                {{ $community->name }}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="px-3 text-xs text-gray-400 italic">
                        Belum mengikuti community
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="border-b my-5 border-black/10 w-full"></div>
    @endauth

    {{-- DISCOVER COMMUNITIES --}}
    <div>
        <h3 class="px-3 mb-2 text-xs font-semibold uppercase text-gray-500">
            Discover Communities
        </h3>

        <ul class="space-y-1">
            @forelse ($communities as $community)
                <li>
                    <a  
                        href="{{ route('communities.show', $community) }}"
                        class="flex items-center gap-3 px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-100 hover:text-[#3e2b2c]"
                    >

                        <x-community-icon :community="$community" size="26" />

                        <span class="truncate">
                            {{ $community->name }}
                        </span>
                    </a>
                </li>
            @empty
                <li class="px-3 text-xs text-gray-400 italic">
                    Community belum tersedia
                </li>
            @endforelse
        </ul>

        {{-- ACTIONS --}}
        <div class="mt-4 space-y-2 px-3">
            <a  
                href=""
                class="flex items-center gap-2 text-[#9966CC] font-semibold hover:underline">
                <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                Cari Community
            </a> --}}

            @auth
                <a 
                    href="{{ route('communities.create') }}"
                    class="flex items-center gap-2 text-[#9966CC] font-semibold hover:underline">
                    <x-heroicon-o-plus-circle class="w-4 h-4" />
                    Create Community
                </a>
            @endauth
        </div>
    </div>

    <div class="mt-10" >
    @ads
    <x-ad-banner />
@endads

    </div>
</aside>
