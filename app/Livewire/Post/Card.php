<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class Card extends Component
{
    public $post;

    protected $listeners = ['refreshVotes' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post->loadSum('votes', 'value')->loadCount('comments');
    }

    public function vote($value)
    {
        $userId = Auth::id();
        if (!$userId) return;

        $existingVote = Vote::where('post_id', $this->post->id)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingVote) {
            if ($existingVote->value == $value) {
                $existingVote->delete();
            } else {
                $existingVote->update(['value' => $value]);
            }
        } else {
            Vote::create([
                'user_id' => $userId,
                'post_id' => $this->post->id,
                'value' => $value,
            ]);
        }

        // refresh post agar angka like/dislike update langsung
        $this->post->loadSum('votes', 'value');
    }

    public function render()
    {
        return view('livewire.components.card');
    }
}