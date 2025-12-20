<aside
    class="fixed top-20 left-0 w-64 h-[calc(100vh-5rem)]
           bg-white border-r px-4 py-6
           overflow-y-auto z-40 text-sm">

    {{-- MAIN NAV --}}
    <div class="space-y-1">
        <a href="{{ route('home') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md
                  font-medium text-gray-700
                  hover:bg-gray-100 hover:text-orange-600">
            🏠 Home
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded-md
                  font-medium text-gray-700
                  hover:bg-gray-100 hover:text-orange-600">
            🔥 Popular
        </a>
    </div>

    <hr class="my-5">

    {{-- FOLLOWING COMMUNITY --}}
    <div>
        <h3 class="px-3 mb-2 text-xs font-semibold uppercase text-gray-500">
            Following Communities
        </h3>

        <ul class="space-y-1">
            @forelse ($followingCommunities as $community)
                <li>
                    <a href="{{ route('communities.show', $community->id) }}"
                       class="flex items-center gap-3 px-3 py-1.5 rounded-md
                              text-gray-700 font-medium
                              hover:bg-gray-100 hover:text-orange-600">

                        {{-- COMMUNITY ICON --}}
                        <x-community-icon
                            :community="$community"
                            size="28"
                        />

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

    <hr class="my-5">

    {{-- DISCOVER COMMUNITY --}}
    <div>
        <h3 class="px-3 mb-2 text-xs font-semibold uppercase text-gray-500">
            Discover Communities
        </h3>

        <ul class="space-y-1">
            @foreach ($communities as $community)
                <li>
                    <a href="{{ route('communities.show', $community->id) }}"
                       class="flex items-center gap-3 px-3 py-1.5 rounded-md
                              text-gray-700
                              hover:bg-gray-100 hover:text-orange-600">

                        {{-- COMMUNITY ICON --}}
                        <x-community-icon
                            :community="$community"
                            size="28"
                        />

                        <span class="truncate">
                            {{ $community->name }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-4 space-y-2 px-3">
            <a href="{{ route('communities.index') }}"
               class="block text-orange-600 font-semibold hover:underline">
                🔍 Cari Community
            </a>
        </div>

        {{-- ACTION --}}
        <div class="mt-4 space-y-2 px-3">
            <a href="{{ route('communities.create') }}"
               class="block text-orange-600 font-semibold hover:underline">
                + Create Community
            </a>
        </div>
    </div>

</aside>
