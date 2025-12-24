<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;

    public function mount()
    {
        // Ambil semua post terbaru
        $this->posts = Post::with('user', 'community')->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.posts')
            ->layout('layouts.admin');
    }
}
