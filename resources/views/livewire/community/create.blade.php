<div class="max-w-2xl mx-auto mt-8 px-4 sm:px-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md border border-gray-200 dark:border-gray-800">

        <div class="px-5 py-4 border-b dark:border-gray-700 bg-gray-50 border-gray-200 dark:bg-[#111b2e]  flex items-center justify-between">
            <h1 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Create Community</h1>
        </div>

        <form wire:submit.prevent="save" class="space-y-4 sm:space-y-5">

            <div class="p-5 sm:p-6">
                <label class="text-xs font-medium text-gray-500 mb-1 block">Community Name</label>
                <input type="text" wire:model="name"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white transition">
                @error('name')<span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div wire:ignore class="p-5 sm:p-6">
                <label class="text-xs font-medium text-gray-500 mb-1 block">Description</label>
                <x-trix-input id="description" name="description" wire:model.defer="description" />
                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 sm:px-6 sm:py-3 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm sm:text-base">
                Create Community
            </button> --}}

            <div class="px-5 py-4 border-t dark:border-gray-700 border-gray-200 bg-gray-50 flex justify-end dark:bg-[#111b2e]">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm font-medium px-6 py-2.5 rounded-full transition">
                Create Community
            </button>
        </div>
        </form>
    </div>
</div>
