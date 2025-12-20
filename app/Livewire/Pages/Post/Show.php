<?php

namespace App\Livewire\Pages\Post;

use Livewire\Component;
use App\Models\Post;

class Show extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post->load([
            'user',
            'community',
            'images',
            'comments.user'
        ]);

        // tambah view
        $this->post->increment('views');
    }

    public function render()
    {
        return view('livewire.pages.post.show');
    }
}
