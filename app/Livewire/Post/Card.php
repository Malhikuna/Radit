<?php
<<<<<<< HEAD:app/Livewire/Post/Card.php

namespace App\Livewire\Post;
=======
namespace App\Livewire\Components;
>>>>>>> c87eae3 (feat: crud comment):app/Livewire/Components/Card.php

use Livewire\Component;
use App\Models\Post;

class Card extends Component
{
    public Post $post;

    protected $listeners = ['voteUpdated' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post->loadSum('votes', 'value')
                           ->loadCount('comments');
    }

    public function render()
    {
        return view('livewire.components.card');
    }
}