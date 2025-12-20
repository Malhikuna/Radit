<?php

namespace App\Livewire\Pages\Community;

use Livewire\Component;
use App\Models\Community;

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

    public function render()
    {
        return view('livewire.pages.community.show', [
            'posts' => $this->community->posts,
        ])->layout('components.layout', [
            'title' => 'r/' . $this->community->name,
        ]);
    }
}
