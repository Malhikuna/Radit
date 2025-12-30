<div class="max-w-2xl mx-auto mt-8 px-4 sm:px-6"> {{-- Lebih compact --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md border border-gray-200 dark:border-gray-800 p-5 sm:p-6">
        <h1 class="text-xl sm:text-2xl font-semibold mb-4 dark:text-white">Create Community</h1>

        {{-- Notifikasi --}}
        @if (session()->has('success'))
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-3 mb-4 rounded-md shadow-sm border border-green-200 dark:border-green-700 text-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Form --}}
        <form wire:submit.prevent="save" class="space-y-4 sm:space-y-5">

            {{-- Community Name --}}
            <div>
                <label class="block mb-1 text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200">Community Name</label>
                <input type="text" wire:model="name"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white transition shadow-sm hover:shadow-md">

                @error('name')
                <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block mb-1 text-sm sm:text-base font-medium text-gray-700 dark:text-gray-200">Description</label>
                <input id="description" type="hidden" wire:model="description">
                <trix-editor input="description"
                    class="trix-content w-full dark:bg-gray-800 dark:text-white shadow-sm hover:shadow-md transition text-sm sm:text-base rounded-md"></trix-editor>

                @error('description')
                <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 sm:px-6 sm:py-3 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm sm:text-base">
                Create Community
            </button>
        </form>
    </div>
</div>
