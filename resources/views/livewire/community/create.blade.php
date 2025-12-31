<div class="max-w-2xl mx-auto mt-1 mb-5">
    <div class="p-4 bg-white dark:bg-gray-900 rounded-lg shadow border border-gray-100 dark:border-gray-900">
        <h1 class="text-xl font-bold mb-4 dark:text-white">Create Community</h1>

        <form class="space-y-5">

            {{-- BANNER IMAGE (FE ONLY) --}}
            <div>
                <label class="block mb-2 dark:text-gray-200">Community Banner</label>

                <div class="w-full h-40 flex items-center justify-center
                            border-2 border-dashed border-gray-300 dark:border-gray-700
                            rounded-lg text-gray-400">
                    @if ($banner_image)
                        <img src="{{ $banner_image->temporaryUrl() }}" class="w-full h-full object-cover">
                    @else
                        <span>Banner Image (16:9)</span>
                    @endif

                    <div wire:loading wire:target="banner_image" class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-sm">
                        Uploading...
                    </div>
                </div>

                <input type="file"
                        wire:model="banner_image"
                       accept="image/*"
                       class="mt-2 w-full text-sm text-gray-600 dark:text-gray-300">

                @error('banner_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- PROFILE IMAGE (FE ONLY) --}}
            <div>
                <label class="block mb-2 dark:text-gray-200">Community Profile</label>

                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center
                                border-2 border-dashed border-gray-300 dark:border-gray-700
                                text-gray-400">
                        @if ($profile_image)
                            <img src="{{ $profile_image->temporaryUrl() }}" class="w-full h-full object-cover">
                        @else
                        Logo
                        @endif

                        <div wire:loading wire:target="profile_image" class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs">
                            ...
                        </div>
                    </div>

                    <input type="file"
                            wire:model="profile_image"
                           accept="image/*"
                           class="text-sm text-gray-600 dark:text-gray-300">
                </div>
                @error('profile_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- NAME --}}
            <div>
                <label class="block mb-1 dark:text-gray-200">Name Community</label>
                <input type="text"
                    wire:model.blur="name"
                    class="w-full border border-gray-200 dark:border-gray-700 rounded p-2
                           focus:outline-none focus:ring-1 focus:ring-purple-500
                           dark:text-white dark:bg-gray-800">
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div wire:ignore class="p-5 sm:p-6 pl-0 sm:pl-0 border border-gray-200 dark:border-gray-700 rounded">
                <label class="text-xs font-medium text-gray-500 mb-1 block">Description</label>
                <x-trix-input id="description" name="description" wire:model.defer="description" />
            </div>
            @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror

            {{-- SUBMIT --}}
            <div class="px-5 py-4 border-t dark:border-gray-700 border-gray-200 bg-gray-50 flex justify-end dark:bg-[#111b2e]">
                <button type="button" 
                        wire:click="confirmSave"
                        wire:loading.attr="disabled"
                        class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm font-medium px-6 py-2.5 rounded-full transition disabled:opacity-50">
                    Create Community
                </button>
            </div>

        </form>
    </div>
</div>
