<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class PostList extends Component
{
    public string $sort = 'new';
    public string $search = '';

    public int $limit = 10;
    public bool $hasMore = true;

    protected $queryString = ['sort'];

    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetList();
    }

    public function updatedSort()
    {
        $this->resetList();
    }

    private function resetList()
    {
        $this->limit = 10;
        $this->hasMore = true;
    }

    public function loadMore()
    {
        if ($this->hasMore) {
            $this->limit += 10;
        }
    }

    public function getPostsProperty()
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

        match ($this->sort) {
            'best', 'top' => $query->orderByDesc('votes_sum_value'),
            'old'         => $query->orderBy('created_at'),
            'discussed'   => $query->orderByDesc('comments_count'),
            default       => $query->latest(),
        };

        $posts = $query->take($this->limit)->get();

        $this->hasMore = $posts->count() >= $this->limit;

        return $posts;
    }

    public function vote($postId, $value)
    {
        $post = Post::find($postId);
        if (!$post) return;

        $vote = $post->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            $vote->value == $value
                ? $vote->delete()
                : $vote->update(['value' => $value]);
        } else {
            $post->votes()->create([
                'user_id' => Auth::id(),
                'value'   => $value,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.post.post-list', [
            'posts' => $this->posts
        ]);
    }
}
