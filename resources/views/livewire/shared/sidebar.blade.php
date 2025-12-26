<aside
    class="fixed top-20 left-0 w-64 h-[calc(100vh-5rem)] bg-white border-r border-gray-200 px-4 py-6 overflow-y-auto z-40 text-sm">

    {{-- MAIN NAV --}}
    <div class="space-y-1">
        <a 
            href="{{ route('home') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md font-medium 
                        {{ 
                            request()->routeIs('home') && !request()->has('sort')
                            ? 'bg-[#e6dadb] text-black'
                            : 'text-black hover:bg-gray-100 hover:text-[#3e2b2c]' 
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
                        ? 'bg-[#e6dadb] text-black'
                        : 'text-black hover:bg-gray-100 hover:text-[#3e2b2c]' 
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
                href="{{ route('communities.index') }}"
                class="flex items-center gap-2 text-[#3e2b2c] font-semibold hover:underline">
                <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                Cari Community
            </a>

            @auth
                <a 
                    href="{{ route('communities.create') }}"
                    class="flex items-center gap-2 text-[#3e2b2c] font-semibold hover:underline">
                    <x-heroicon-o-plus-circle class="w-4 h-4" />
                    Create Community
                </a>
            @endauth
        </div>
    </div>

    <div class="mt-10" >
           {{-- SIMPLE AD --}}
    <livewire:simple-ad />
    </div>
</aside>
