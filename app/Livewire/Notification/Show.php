<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public function markAllAsRead()
    {
        $user = Auth::user();

        // Tandai semua notifikasi yang belum dibaca
        $user->unreadNotifications->markAsRead();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notification.show', [
            'title' => 'Notifications'
        ]);
    }
}
