<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use Livewire\Attributes\On;

class FlashMessage extends Component
{
    public $show = false;
    public $type = 'success';
    public $message = '';
    public $redirect = null;

    #[On('flash')]
    public function showMessage($type, $message, $redirect = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->redirect = $redirect;
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.shared.flash-message');
    }
}