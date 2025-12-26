<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use Livewire\Attributes\Layout;

class UserProfile extends Component
{
    public User $user;
    public $posts;
    public $comments;
    public int $karma = 0;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->loadData();
    }

    protected function loadData()
    {
        $this->posts = Post::with(['community','images','votes'])
            ->withCount('comments')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        $this->comments = Comment::with('post')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        $this->karma =
            Vote::whereIn('post_id', $this->posts->pluck('id'))->sum('value') +
            Vote::whereIn('comment_id', $this->comments->pluck('id'))->sum('value');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-profile', [
            'title' => 'u/' . $this->user->name,
        ]);
    }
}
