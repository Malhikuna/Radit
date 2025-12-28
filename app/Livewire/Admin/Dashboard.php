<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Community;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalPosts;
    public $totalCommunities;

    public function mount()
    {
        // Hitung data untuk statistik dashboard
        $this->totalUsers = User::count();
        $this->totalPosts = Post::count();
        $this->totalCommunities = Community::count();
    }

    public function render()
    {
        // Gunakan layout khusus admin
        return view('livewire.admin.dashboard', [
            'totalUsers' => $this->totalUsers,
            'totalPosts' => $this->totalPosts,
            'totalCommunities' => $this->totalCommunities,
        ])->layout('layouts.admin');
    }
}
