<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostList extends Component
{
    public $sort = 'new';

    public function render()
    {
        $query = Post::withSum('votes', 'value');

        if ($this->sort === 'best') {
            $query->orderByDesc('votes_sum_value');
        } else {
            $query->orderByDesc('created_at');
        }

        $posts = $query->get();

        return view('livewire.components.post-list', compact('posts'));
    }
}