<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public Community $community;

    public function mount(Community $community): void
    {
        // Load data dasar community
        $this->community = $community->loadCount('members');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.show', [
            'community' => $this->community,
            'title' => 'r/' . $this->community->name
        ]);
    }
}
