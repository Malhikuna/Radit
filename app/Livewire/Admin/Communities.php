<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Community;

class Communities extends Component
{
    public $communities;

    public function mount()
    {
        // Ambil semua komunitas terbaru
        $this->communities = Community::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.communities')
            ->layout('layouts.admin');
    }
}
