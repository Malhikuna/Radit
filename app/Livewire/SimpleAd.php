<?php

namespace App\Livewire;

use Livewire\Component;

class SimpleAd extends Component
{
    public bool $showAd = true;

    public function closeAd()
    {
        $this->showAd = false;
    }

    public function goToCheckout()
    {
        return redirect()->to('/checkout');
    }

    public function render()
    {
        return view('livewire.simple-ad');
    }
}
