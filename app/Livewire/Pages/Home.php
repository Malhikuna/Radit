<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.pages.home');
    }
}