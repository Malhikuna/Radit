<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Post;

class Search extends Component
{
    public $query = '';

    public function mount()
    {
        $this->query = request('q') ?: '';
    }

    public function render()
    {
        $posts = [];

        if ($this->query) {
            $posts = Post::where(function ($q) {
                $q->where('title', 'like', '%' . $this->query . '%')
                    ->orWhere('content', 'like', '%' . $this->query . '%');
            })
                // Tambahkan pencarian berdasarkan user name
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->query . '%');
                })
                ->latest()
                ->get();
        }


        return view('livewire.pages.search', [
            'posts' => $posts
        ])->layout('components.layout', [
            'title' => 'Search'
        ]);
    }
}
