<div 
    x-data="{ 
        show: @entangle('show'), 
        redirect: @entangle('redirect') 
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display: none;" 
    class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4"
>
    <div 
        @click.away="if(!redirect) show = false" 
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center transform transition-all scale-100"
    >
        
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full mb-5
            {{ $type === 'success' ? 'bg-green-100 dark:bg-green-900/30' : '' }}
            {{ $type === 'error' ? 'bg-red-100 dark:bg-red-900/30' : '' }}
            {{ $type === 'info' ? 'bg-blue-100 dark:bg-blue-900/30' : '' }}
        ">
            @if($type === 'success')
                <svg class="h-10 w-10 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            @elseif($type === 'error')
                <svg class="h-10 w-10 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            @else
                <svg class="h-10 w-10 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
        </div>

        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
            @if($type === 'success') Success! 
            @elseif($type === 'error') Error!
            @else Notification
            @endif
        </h3>

        <p class="text-gray-500 dark:text-gray-300 text-sm mb-6">
            {{ $message }}
        </p>

        <button 
            type="button"
            @click="
                show = false; 
                // Logika Redirect Manual saat tombol diklik
                if (redirect) {
                    window.location.href = redirect;
                }
            "
            class="w-full inline-flex justify-center rounded-xl px-4 py-3 text-sm font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors
            {{ $type === 'success' ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500' : '' }}
            {{ $type === 'error' ? 'bg-red-600 hover:bg-red-700 focus:ring-red-500' : '' }}
            {{ $type === 'info' ? 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' : '' }}
            "
        >
            OK
        </button>

    </div>
</div>