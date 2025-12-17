<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommunityIcon extends Component
{
    public $community;
    public $size;

    public function __construct($community, $size = 32)
    {
        $this->community = $community;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.community-icon');
    }
}
