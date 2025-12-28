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
    
    protected $queryString = ['sort'];

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

    public function loadMore()
    {
        $this->perPage += 10;
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

        match ($this->sort) {
            'best'      => $query->orderByDesc('votes_sum_value'),
            'top'       => $query->orderByDesc('votes_sum_value'),
            'old'       => $query->orderBy('created_at'),
            'discussed' => $query->orderByDesc('comments_count'),
            default     => $query->latest(),
        };

        return view('livewire.post.post-list', [
            'posts' => $query->paginate(10),
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