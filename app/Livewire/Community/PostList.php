<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class PostList extends Component
{
    public $sort = 'new';
    public $search = '';
    public $communityId;

    public int $perPage = 10;
    public bool $hasMore = true;

    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->perPage = 10;
    }

    public function updatedSort() 
    {
        $this->perPage = 10;
    }

    public function mount($communityId)
    {
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
            ->withSum('votes', 'value')
            ->where('community_id', $this->communityId);

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        match ($this->sort) {
            'best' => $query->orderByDesc('votes_sum_value'),
            default => $query->latest(),
        };

        $countQuery = clone $query;
        $totalPosts = $countQuery->count();

        $posts = $query->take($this->perPage)->get();    
            
        $this->hasMore = $posts->count() < $totalPosts;

        return view('livewire.community.post-list', [
            'posts' => $posts,
        ]);
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
    }

    public function setSort($type)
    {
        $this->sort = $type;
    }
}