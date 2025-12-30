<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public string $sort = 'new';
    public string $search = '';

    public int $perPage = 10;
    public bool $hasMore = true;

    public $userId = null;
    public $communityId = null;    
    
    protected $queryString = ['sort'];

    /* #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->perPage = 10;
    } */

    public function updatedSort()
    {
        $this->perPage = 10;
    }

    public function mount($search = '', $userId = null, $communityId = null)
    {
        $this->search = $search;
        $this->userId = $userId;
        $this->communityId = $communityId;
    }

    public function loadMore()
    {
        if ($this->hasMore) {
            $this->perPage += 10;
        }
    }

    public function render()
    {
        $query = Post::with(['user', 'images', 'votes'])
            ->withCount('comments')
            ->withSum('votes', 'value');

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        if ($this->communityId) {
            $query->where('community_id', $this->communityId);
        }

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        match ($this->sort) {
            'best'      => $query->orderByDesc('votes_sum_value'),
            'top'       => $query->orderByDesc('votes_sum_value'),
            'old'       => $query->orderBy('created_at'),
            'discussed' => $query->orderByDesc('comments_count'),
            default     => $query->latest(),
        };

        $countQuery = clone $query;
        $totalPosts = $countQuery->count();

        $posts = $query->take($this->perPage)->get();

        $this->hasMore = $posts->count() < $totalPosts;

        return view('livewire.post.post-list', [
            'posts' => $posts,
        ]);
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
}