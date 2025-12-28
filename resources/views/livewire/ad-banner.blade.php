<div> {{-- Root tag Livewire --}}
    @if($showAd)
        <div 
            class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded relative shadow-md animate-bounce max-w-md cursor-pointer"
            wire:click="goToCheckout"
        >
            🚀 Upgrade ke Premium untuk bebas iklan dan akses fitur eksklusif!
            <button 
                wire:click.stop="closeAd" 
                class="absolute top-1 right-1 font-bold text-gray-600 hover:text-gray-900"
            >
                ✕
            </button>
        </div>
    @endif
</div>
