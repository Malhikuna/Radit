<div class="w-full max-w-5xl mx-auto px-4 py-6">

    {{-- SEARCH BAR --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center w-full bg-white border border-gray-300 rounded-full px-4 py-2 shadow-sm">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 10.5a7.5 7.5 0 0013.15 6.15z" />
            </svg>

            <input
                type="text"
                placeholder="Search Reddit"
                class="w-full outline-none text-sm bg-transparent"
            />
        </div>

        <button
            class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-full">
            Ask
        </button>
    </div>

    {{-- FILTER TABS --}}
    <div class="flex items-center gap-3 mb-8">
        <button class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
            All
        </button>

        <button
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            Posts
        </button>

        <button
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            Communities
        </button>

        <button
            class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700">
            People
        </button>
    </div>

    {{-- CONTENT PLACEHOLDER --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT / MAIN CONTENT --}}
        <div class="md:col-span-2 space-y-4">

            <div class="bg-white border rounded-lg p-4">
                <h3 class="font-semibold text-sm mb-2">
                    Can Batman be real?
                </h3>
                <p class="text-xs text-gray-500">
                    r/batman • 1 hour ago
                </p>
            </div>

            <div class="bg-white border rounded-lg p-4">
                <h3 class="font-semibold text-sm mb-2">
                    I hope DCU Batman moves like this!
                </h3>
                <p class="text-xs text-gray-500">
                    r/DCU_ • 2 hours ago
                </p>
            </div>

        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="space-y-4">
            <div class="bg-white border rounded-lg p-4">
                <h4 class="font-semibold text-sm mb-3">
                    Communities
                </h4>

                <ul class="space-y-2 text-sm text-gray-700">
                    <li>r/batman_comics</li>
                    <li>r/dccomicscirclejerk</li>
                    <li>r/BatmanTAS</li>
                    <li>r/batgirl</li>
                </ul>
            </div>
        </div>

    </div>

</div>
