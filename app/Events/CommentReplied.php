<?php

namespace App\Events;

class CommentReplied
{
    public $comment;
    public $repliedBy;

    // Menyimpan data comment dan user yang membalas
    public function __construct($comment, $repliedBy)
    {
        $this->comment = $comment;
        $this->repliedBy = $repliedBy;
    }
}
