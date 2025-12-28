<?php

namespace App\Events;

class PostVoted
{
    public $post;
    public $votedBy;

    // Menyimpan data post & user yang melakukan vote
    public function __construct($post, $votedBy)
    {
        $this->post = $post;
        $this->votedBy = $votedBy;
    }
}
