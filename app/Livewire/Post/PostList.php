<?php

namespace App\Livewire\Post;

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

<<<<<<< HEAD:app/Livewire/Post/PostList.php
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
=======
        return view('livewire.components.post-list', [
            'posts' => $query->get()
        ]);
>>>>>>> 235d953b77b221caa7e2489c340946dc09ab07f7:app/Livewire/Components/PostList.php
    }
}