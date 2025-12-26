<div class="max-w-7xl mx-auto">

    {{-- COMMUNITY HEADER --}}
    <div class="bg-white rounded-lg border border-gray-200 mb-6 overflow-hidden">

        {{-- BANNER --}}
        <div class="h-32 bg-gradient-to-r from-[#3e2b2c] to-[#3e2b2c]"></div>

        <div class="p-6 flex items-center gap-4">

            {{-- ICON --}}
            <div
<<<<<<< Updated upstream
<<<<<<< HEAD
                class="w-16 h-16 rounded-full bg-purple-500 text-white flex items-center justify-center text-2xl font-bold">
=======
                class="w-16 h-16 rounded-full bg-[#9966CC] border-[#7A49A6] text-white
                       flex items-center justify-center text-2xl font-bold">
>>>>>>> b6fc0963f8d5fcdaac5cf6e334062f6bab56b8dc
=======
                class="w-16 h-16 rounded-full bg-[#3e2b2c] text-white
                       flex items-center justify-center text-2xl font-bold">
>>>>>>> Stashed changes
                {{ strtoupper(substr($community->name, 0, 1)) }}
            </div>

            {{-- TITLE --}}
            <div>
                <h1 class="text-2xl font-bold">
                    c/{{ $community->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $community->members_count }} members
                </p>
            </div>

            {{-- ACTIONS --}}
            <div class="ml-auto flex items-center gap-3">
<<<<<<< Updated upstream
<<<<<<< HEAD
                <a 
                    href="{{ route('posts.create') }}"
                    class="px-4 py-2 rounded-full bg-purple-500 text-white font-semibold hover:bg-purple-600">
=======
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 rounded-full bg-[#9966CC]
                          text-white font-semibold hover:bg-[#7A49A6]">
>>>>>>> b6fc0963f8d5fcdaac5cf6e334062f6bab56b8dc
=======
                <a href="{{ route('posts.create') }}"
                   class="px-4 py-2 rounded-full bg-[#3e2b2c]
                          text-white font-semibold hover:bg-[#3e2b2c]">
>>>>>>> Stashed changes
                    + Create Post
                </a>

                <button
<<<<<<< Updated upstream
<<<<<<< HEAD
                    class="px-4 py-2 rounded-full border border-purple-500 text-purple-500 font-semibold hover:bg-purple-50">
=======
                    class="px-4 py-2 rounded-full border border-[#4480e7]
                           text-white font-semibold hover:bg-[#4480e7] bg-[#6395ee]">
>>>>>>> b6fc0963f8d5fcdaac5cf6e334062f6bab56b8dc
=======
                    class="px-4 py-2 rounded-full border border-[#3e2b2c]
                           text-[#3e2b2c] font-semibold hover:bg-[#3e2b2c]">
>>>>>>> Stashed changes
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
