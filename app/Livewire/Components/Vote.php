<?php
namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use App\Models\Vote as VoteModel;
use Illuminate\Support\Facades\Auth;

class Vote extends Component
{
    public Post $post;
    public int $userVote = 0;
    public int $score = 0;

    // Mount component
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->updateVoteData();
    }

    // Handle voting
    public function vote(int $value)
    {
        if (!Auth::check()) return; // Jika belum login, tidak boleh vote

        $existingVote = $this->post->votes()->where('user_id', Auth::id())->first();

        if ($existingVote) {
            if ($existingVote->value === $value) {
                // Cancel vote
                $existingVote->delete();
                $this->userVote = 0;
            } else {
                // Update vote
                $existingVote->update(['value' => $value]);
                $this->userVote = $value;
            }
        } else {
            // Create new vote
            VoteModel::create([
                'user_id' => Auth::id(),
                'post_id' => $this->post->id,
                'value' => $value,
            ]);
            $this->userVote = $value;
        }

        $this->updateVoteData();
    }

    // Update score dan userVote
    private function updateVoteData()
    {
        $this->score = $this->post->votes()->sum('value');

        if (Auth::check()) {
            $this->userVote = $this->post->votes()
                ->where('user_id', Auth::id())
                ->value('value') ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.components.vote');
    }
}
