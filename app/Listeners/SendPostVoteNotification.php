<?php

namespace App\Listeners;

use App\Events\PostVoted;
use App\Livewire\Notification\PostVoteNotification;

class SendPostVoteNotification
{
    public function handle(PostVoted $event)
    {
        $postOwner = $event->post->user;

        if ($postOwner->id !== $event->votedBy->id) {
            $postOwner->notify(
                new PostVoteNotification($event->post)
            );
        }
    }
}
