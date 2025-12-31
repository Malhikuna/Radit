<div class="max-w-2xl mx-auto mt-1">
    <div class="p-4 bg-white dark:bg-gray-900 rounded-lg shadow border border-gray-100 dark:border-gray-900">
        <h1 class="text-xl font-bold mb-4 dark:text-white">Create Community</h1>

        <form class="space-y-5">

            {{-- BANNER IMAGE (FE ONLY) --}}
            <div>
                <label class="block mb-2 dark:text-gray-200">Community Banner</label>

                <div class="w-full h-40 flex items-center justify-center
                            border-2 border-dashed border-gray-300 dark:border-gray-700
                            rounded-lg text-gray-400">
                    Banner Image (16:9)
                </div>

                <input type="file"
                       class="mt-2 w-full text-sm text-gray-600 dark:text-gray-300">
            </div>

            {{-- PROFILE IMAGE (FE ONLY) --}}
            <div>
                <label class="block mb-2 dark:text-gray-200">Community Profile</label>

                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center
                                border-2 border-dashed border-gray-300 dark:border-gray-700
                                text-gray-400">
                        Logo
                    </div>

                    <input type="file"
                           class="text-sm text-gray-600 dark:text-gray-300">
                </div>
            </div>

            {{-- NAME --}}
            <div>
                <label class="block mb-1 dark:text-gray-200">Name Community</label>
                <input type="text"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded p-2
                           focus:outline-none focus:ring-1 focus:ring-purple-500
                           dark:text-white dark:bg-gray-800">
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block mb-1 dark:text-gray-200">Description</label>
                <textarea
                    class="w-full border border-gray-200 dark:border-gray-700 rounded p-2
                           focus:outline-none focus:ring-1 focus:ring-purple-500
                           dark:text-white dark:bg-gray-800"></textarea>
            </div>

            {{-- SUBMIT --}}
            <button
                class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition">
                Create
            </button>

        </form>
    </div>
</div>
