<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.show');
    }
}
