<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Layout;

class Search extends Component
{
    public $query = '';

    public function mount()
    {
        $this->query = request('q') ?: '';
    }
    
    #[Layout('layouts.app')]
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

        return view('livewire.search', [
            'posts' => $posts,
            'title' => 'Search'
        ]);
    }
}