<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Notifications
        </h1>

        @if(auth()->user()->unreadNotifications->count())
            <button
                wire:click="markAllAsRead"
                class="text-sm text-blue-600 hover:underline"
            >
                Mark all as read
            </button>
        @endif
    </div>

    {{-- LIST --}}
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow divide-y divide-gray-100 dark:divide-gray-800">

        @forelse(auth()->user()->notifications as $notification)

            {{-- COMMENT REPLY --}}
            @if($notification->data['type'] === 'comment_reply')
                @include('livewire.notification.comment-replied-notification', [
                    'notification' => $notification
                ])
            @endif

            {{-- POST VOTE --}}
            @if($notification->data['type'] === 'post_vote')
                @include('livewire.notification.post-vote-notification', [
                    'notification' => $notification
                ])
            @endif

        @empty
            <div class="py-12 text-center text-gray-500">
                No notifications yet
            </div>
        @endforelse

    </div>
</div>
