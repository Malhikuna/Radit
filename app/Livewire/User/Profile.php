<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use Livewire\Attributes\Layout;

class Profile extends Component
{
    public $user;
    public $posts;
    public $comments;
    public int $karma = 0;

    public function mount()
    {
        $this->user = Auth::user();
        abort_if(! $this->user, 403);

        /**
         * POSTS (WAJIB sesuai post-card)
         */
        $this->posts = Post::with([
                'user',
                'community',
                'images',
                'votes',
            ])
            ->withCount('comments')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        /**
         * COMMENTS
         */
        $this->comments = Comment::with([
                'post',
                'post.community',
            ])
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        /**
         * KARMA (Reddit Style)
         */
        $this->karma =
            Vote::whereIn('post_id', $this->posts->pluck('id'))->sum('value') +
            Vote::whereIn('comment_id', $this->comments->pluck('id'))->sum('value');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.profile', [
            'title' => 'My Profile',
        ]);
    }
}
