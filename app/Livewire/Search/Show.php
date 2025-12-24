<?php

namespace App\Livewire\Search;

use Livewire\Component;
use Livewire\Attributes\Layout;


class Show extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.search.show');
    }
}
