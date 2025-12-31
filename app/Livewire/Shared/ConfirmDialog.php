<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use Livewire\Attributes\On;

class ConfirmDialog extends Component
{
    public $show = false;
    public $title = 'Are you sure?';
    public $description = 'This action cannot be undone.';
    
    public $confirmAction = null; 
    public $confirmParams = [];

    #[On('open-confirm')]
    public function open($action, $params = [], $title = null, $description = null)
    {
        $this->confirmAction = $action; // Update properti
        $this->confirmParams = $params;
        
        if($title) $this->title = $title;
        if($description) $this->description = $description;
        
        $this->show = true;
    }

    public function confirm()
    {
        if ($this->confirmAction) {
            $this->dispatch($this->confirmAction, ...$this->confirmParams);
        }
        $this->show = false;
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.shared.confirm-dialog');
    }
}