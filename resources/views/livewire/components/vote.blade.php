<div class="flex items-center gap-2 select-none">
    {{-- Upvote --}}
    <button wire:click.stop="vote(1)"
        class="cursor-pointer flex items-center justify-center text-gray-400 hover:text-red-500 dark:text-white transition duration-150 {{ $userVote === 1 ? 'text-red-600 font-bold' : '' }}">
        <x-heroicon-s-chevron-up class="w-5 h-5"/>
    </button>

    {{-- Score --}}
    <span class="font-semibold text-gray-700 dark:text-white">{{ $score }}</span>

    {{-- Downvote --}}
    <button wire:click.stop="vote(-1)"
        class="cursor-pointer flex items-center justify-center text-gray-400 hover:text-blue-500 dark:text-white transition duration-150 {{ $userVote === -1 ? 'text-blue-600 font-bold' : '' }}">
        <x-heroicon-s-chevron-down class="w-5 h-5"/>
    </button>
</div>
