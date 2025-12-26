<?php

namespace App\Livewire\Premium;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    #[Layout('layouts.app', ['hideSidebar' => true])]
    public function render()
    {
        return view('livewire.premium.show');
    }
}
