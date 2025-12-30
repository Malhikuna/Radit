<div class="max-w-2xl mx-auto mt-8 px-4 sm:px-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md border border-gray-200 dark:border-gray-800 p-5 sm:p-6">
        <h1 class="text-xl sm:text-2xl font-semibold mb-4 dark:text-white">Create Community</h1>

        <form wire:submit.prevent="save" class="space-y-4 sm:space-y-5">

            <div>
                <label class="block mb-1 text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200">Community Name</label>
                <input type="text" wire:model="name"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white transition shadow-sm hover:shadow-md">
                @error('name')<span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div wire:ignore>
                <label class="text-xs font-medium text-gray-600 mb-1 block">Description</label>
                <x-trix-input id="description" name="description" wire:model.defer="description" />
                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 sm:px-6 sm:py-3 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm sm:text-base">
                Create Community
            </button>
        </form>
    </div>
</div>
