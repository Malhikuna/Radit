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
    public $communityId; // ID community yang sedang dibuka

    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function mount($communityId)
    {
        $this->communityId = $communityId;
    }

    public function render()
    {
        $query = Post::with(['user', 'images', 'votes'])
            ->withCount('comments')
            ->withSum('votes', 'value')
            ->where('community_id', $this->communityId); // filter berdasarkan community

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        $this->sort === 'best'
            ? $query->orderByDesc('votes_sum_value')
            : $query->orderByDesc('created_at');

        return view('livewire.community.post-list', [
            'posts' => $query->paginate(10),
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
