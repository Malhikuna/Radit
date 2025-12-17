<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public $user;
    public $size;

    public function __construct($user, $size = 40)
    {
        $this->user = $user;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.avatar');
    }
}
