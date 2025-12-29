<div class="space-y-8">

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- USERS --}}
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition
                    border-t-4 border-[#9966CC] p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <p class="text-3xl font-bold text-[#7A49A6] mt-2">
                        {{ $totalUsers }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#9966CC]/20
                            flex items-center justify-center text-xl">
                    👤
                </div>
            </div>
        </div>

        {{-- POSTS --}}
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition
                    border-t-4 border-[#9966CC] p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Posts</p>
                    <p class="text-3xl font-bold text-[#7A49A6] mt-2">
                        {{ $totalPosts }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#9966CC]/20
                            flex items-center justify-center text-xl">
                    📝
                </div>
            </div>
        </div>

        {{-- COMMUNITIES --}}
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition
                    border-t-4 border-[#9966CC] p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Communities</p>
                    <p class="text-3xl font-bold text-[#7A49A6] mt-2">
                        {{ $totalCommunities }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#9966CC]/20
                            flex items-center justify-center text-xl">
                    🌐
                </div>
            </div>
        </div>

    </div>

    {{-- RECENT ACTIVITY --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#7A49A6]">
                Recent Activity
            </h2>
            <span class="text-sm text-gray-400">
                Last update
            </span>
        </div>

        <p class="text-gray-500">
            Di sini bisa ditambahkan tabel terbaru, log, atau statistik tambahan.
        </p>
    </div>

</div>
