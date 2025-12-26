<?php
namespace App\Livewire\Components;

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