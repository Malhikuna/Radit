<aside class="w-64 h-screen border-r px-6 py-6">

    <div class="space-y-4">
        <a href="#" class="flex items-center gap-3 text-lg">
            <span>🏠</span> <span>Home</span>
        </a>

        <a href="#" class="flex items-center gap-3 text-lg">
            <span>🔥</span> <span>Populer</span>
        </a>
    </div>

    <hr class="my-6">

    <div>
        <h3 class="text-sm font-semibold mb-2">Following Community</h3>
        <ul class="space-y-2 text-gray-700">
            <li>🧩 Garut Squad</li>
        </ul>
    </div>

    <div class="mt-6">
        <h3 class="text-sm font-semibold mb-2">Community</h3>
        <ul class="space-y-2 text-gray-700">
            <li>👨🏻‍🎓 Teknik Unpas</li>
            <li>🧘 Ambatukam</li>
        </ul>
    </div>

    <div class="mt-6">
        <a href="{{ route('communities.create') }}"
            class="text-orange-600 font-semibold">
            + Create Community
        </a>
    </div>


</aside>