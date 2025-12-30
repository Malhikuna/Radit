<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    // ================= PROPERTIES =================
    public string $sort = 'new';
    public string $search = '';
    public int $perPage = 10;
    public bool $hasMore = true;

    public ?int $userId = null;
    public ?int $communityId = null;

    protected $queryString = ['sort'];

    // ================= SEARCH =================
    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->perPage = 10;
        $this->resetPage(); // reset pagination ketika search berubah
    }

    public function updatedSort()
    {
        $this->perPage = 10;
        $this->resetPage(); // reset pagination ketika sort berubah
    }

    // ================= MOUNT =================
    public function mount($userId = null, $communityId = null)
    {
        $this->search = $search;
        $this->userId = $userId;
        $this->communityId = $communityId;
    }

    // ================= LOAD MORE =================
    public function loadMore()
    {
        if ($this->hasMore) {
            $this->perPage += 10;
        }
    }

    // ================= POST VOTE =================
    public function vote($postId, $value)
    {
        if (!Auth::check()) return;

        $post = Post::find($postId);
        if (!$post) return;

        $vote = $post->votes()->where('user_id', Auth::id())->first();

        if ($vote) {
            $vote->value == $value ? $vote->delete() : $vote->update(['value' => $value]);
        } else {
            $post->votes()->create([
                'user_id' => Auth::id(),
                'value' => $value,
            ]);
        }
    }

    // ================= POLL VOTE =================
    public function votePoll($optionId)
    {
        if (!Auth::check()) return;

        $option = PollOption::find($optionId);
        if (!$option) return;

        $existingVote = PollVote::where('user_id', Auth::id())
            ->whereHas('pollOption', function ($q) use ($option) {
                $q->where('post_id', $option->post_id);
            })->first();

        // batal vote
        if ($existingVote && $existingVote->poll_option_id === $option->id) {
            $existingVote->delete();
            $option->decrement('votes');
            return;
        }

        // ganti vote
        if ($existingVote) {
            PollOption::where('id', $existingVote->poll_option_id)->decrement('votes');
            $existingVote->update(['poll_option_id' => $option->id]);
            $option->increment('votes');
            return;
        }

        // vote baru
        PollVote::create([
            'poll_option_id' => $option->id,
            'user_id' => Auth::id(),
        ]);

        $option->increment('votes');
    }

    // ================= RENDER =================
    public function render()
    {
        $query = Post::with([
                'user',
                'images',
                'votes',
                'pollOptions',
            ])
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

        // SORTING
        match ($this->sort) {
            'best', 'top' => $query->orderByDesc('votes_sum_value'),
            'old'         => $query->orderBy('created_at'),
            'discussed'   => $query->orderByDesc('comments_count'),
            default       => $query->latest(),
        };

        $posts = $query->take($this->perPage)->get();

        $this->hasMore = $posts->count() >= $this->perPage;

        return view('livewire.post.post-list', [
            'posts' => $posts,
        ]);
    }
}