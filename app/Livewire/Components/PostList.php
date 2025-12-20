<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class PostList extends Component
{
    public $sort = 'new';
    public $search = '';

    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function render()
    {
        $query = Post::with(['user', 'images', 'votes'])
            ->withCount('comments')
            ->withSum('votes', 'value');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        $this->sort === 'best'
            ? $query->orderByDesc('votes_sum_value')
            : $query->orderByDesc('created_at');

        return view('livewire.components.post-list', [
            'posts' => $query->get()
        ]);
    }
}
