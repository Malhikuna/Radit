<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use Illuminate\Bus\Queueable;
use Livewire\Attributes\Layout;

class CommentRepliedNotification extends Component
{
    use Queueable;

    protected $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'comment_reply',
            'comment_id' => $this->comment->id,
            'message' => 'Someone replied to your comment.',
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.notification.comment-replied-notification', [
            'title' => 'Comment Notification'
        ]);
    }
}
