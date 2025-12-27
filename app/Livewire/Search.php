<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

class Search extends Component
{
    #[Url(as: 'q')]
    public $query = '';

    #[Url]
    public $filter = 'all';

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /* public function mount()
    {
        $this->query = request('q') ?: '';
    } */
    
    #[Layout('layouts.app')]
    public function render()
    {
        $posts = [];
        $users = [];

        if (strlen($this->query) > 1) {
            if (in_array($this->filter, ['all', 'posts'])) {
                $posts = Post::query()
                    ->with(['user', 'images', 'pollOptions'])
                    ->withCount('comments') 
                    ->where(function ($q) {
                        $q->where('title', 'like', '%' . $this->query . '%')
                            ->orWhere('content', 'like', '%' . $this->query . '%');
                    })
                    ->latest()
                    ->get();
            }

            if (in_array($this->filter, ['all', 'people'])) {
                $users = User::where('name', 'like', '%' . $this->query . '%')
                        ->limit(5)
                        ->get();
            }
        }

        return view('livewire.search.show', [
            'posts' => $posts,
            'users' => $users,
            'title' => 'Search'
        ]);
    }
}