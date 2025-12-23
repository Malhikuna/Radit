<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
// use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class Vote extends Component
{
    public Post $post;
    public int $userVote = 0; // 1 = upvote, -1 = downvote, 0 = none

    public function mount(Post $post)
    {
        $this->post = $post;

        if (Auth::check()) {
            $vote = $post->votes()->where('user_id', Auth::id())->first();
            $this->userVote = $vote ? $vote->value : 0;
        }
    }

    public function vote(int $value)
    {
        if (!Auth::check()) return;

        $vote = $this->post->votes()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['value' => $value]
        );

        $this->userVote = $value;

        $this->emit('voteUpdated', $this->post->id);
    }

    public function render()
    {
        return view('livewire.components.vote', [
            'upvotes' => $this->post->votes()->where('value', 1)->count(),
            'downvotes' => $this->post->votes()->where('value', -1)->count(),
        ]);
    }
}