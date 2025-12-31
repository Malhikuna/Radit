<div
    class="flex gap-4 px-5 py-4
    {{ $notification->read_at ? 'bg-white dark:bg-gray-900' : 'bg-blue-50 dark:bg-gray-800' }}"
>

    {{-- ICON --}}
    <div class="flex-shrink-0">
        <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600
                    flex items-center justify-center">
            ⬆️
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="flex-1">
        <p class="text-sm text-gray-800 dark:text-gray-200">
            {{ $notification->data['message'] }}
        </p>

        <p class="text-xs text-gray-500 mt-1">
            {{ $notification->created_at->diffForHumans() }}
        </p>
    </div>

    {{-- UNREAD DOT --}}
    @if(!$notification->read_at)
        <span class="w-2 h-2 bg-blue-600 rounded-full mt-2"></span>
    @endif
</div>
