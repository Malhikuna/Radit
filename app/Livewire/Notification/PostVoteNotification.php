<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use Illuminate\Bus\Queueable;
use Livewire\Attributes\Layout;

class PostVoteNotification extends Component
{
    use Queueable; // antrian (queue)

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // Data yang disimpan ke tabel notifications
    public function toDatabase($notifiable)
    {
        return [
            'type' => 'post_vote',
            'post_id' => $this->post->id,
            'message' => 'Your post received a new vote.',
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notification.post-vote-notification', [
            'title' => 'Vote Notification'
        ]);
    }
}
