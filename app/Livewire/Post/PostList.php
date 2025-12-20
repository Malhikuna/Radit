<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostList extends Component
{
    public $sort = 'new';

    public function render()
    {
        $query = Post::with(['user', 'images', 'votes'])
                     ->withCount('comments')
                     ->withSum('votes', 'value');

        if ($this->sort === 'best') {
            $query->orderByDesc('votes_sum_value');
        } else {
            $query->orderByDesc('created_at');
        }

        $posts = $query->get();

        return view('livewire.post.post-list', compact('posts'));
    }

    public function vote($postId, $value)
    {
        $post = Post::find($postId);
        if (!$post) return;

        $vote = $post->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            if ($vote->value == $value) {
                $vote->delete();
            } else {
                $vote->value = $value;
                $vote->save();
            }
        } else {
            $post->votes()->create([
                'user_id' => Auth::id(),
                'value' => $value
            ]);
        }

        // **tidak perlu emit() sama sekali**, Livewire akan rerender otomatis
    }

    public function setSort($type)
    {
        $this->sort = $type;
    }
}