<?php

namespace App\Listeners;

use App\Events\CommentReplied;
use App\Livewire\Notification\CommentRepliedNotification;

class SendCommentRepliedNotification
{
    public function handle(CommentReplied $event)
    {
        $commentOwner = $event->comment->user;

        // Jangan kirim notifikasi ke diri sendiri
        if ($commentOwner->id !== $event->repliedBy->id) {
            $commentOwner->notify(
                new CommentRepliedNotification($event->comment)
            );
        }
    }
}
