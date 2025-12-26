<div class="flex items-center gap-2 text-sm text-gray-500">
    <button
        wire:click="toggleJoin"
        class="px-4 py-2 rounded-full font-semibold
               {{ $joined ? 'bg-gray-400 text-white hover:bg-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
        {{ $joined ? 'Joined' : 'Join' }}
    </button>
</div>
