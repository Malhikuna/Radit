<div class="max-w-2xl mx-auto mt-6">
    <div class="p-4 py-4 bg-white dark:bg-gray-900 rounded-lg shadow border border-gray-100 dark:border-gray-900">
        <h1 class="text-xl font-bold mb-4 dark:text-white">Create Community</h1>

        @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label class="block mb-1 dark:text-gray-200">Name Community</label>
                <input type="text" wire:model="name"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded p-2 focus:outline-none focus:ring-1 focus:ring-purple-500 dark:text-white dark:focus:ring-white">

                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1 dark:text-gray-200">Description</label>
                <textarea wire:model="description"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded p-2 focus:outline-none focus:ring-1 focus:ring-purple-500 dark:focus:ring-white dark:text-white"></textarea>

                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button class="bg-purple-500 text-white px-4 py-2 rounded cursor-pointer">
                Create
            </button>
        </form>
    </div>
</div>
