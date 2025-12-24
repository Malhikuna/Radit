<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Comment;

class Comments extends Component
{
    public $comments;

    public function mount()
    {
        // Ambil semua komentar, terbaru di atas
        $this->comments = Comment::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.comments')
            ->layout('layouts.admin');
    }
}
