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
        $this->community = $community
            ->loadCount('members')
            ->load([
                'posts.user',
                'posts.images',
                'posts.votes',
            ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.community.show', [
            'posts' => $this->community->posts,
            'title' => 'r/' . $this->community->name
        ]);
    }
}