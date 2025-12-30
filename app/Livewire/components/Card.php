<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;

class Card extends Component
{
    public Post $post;

    protected $listeners = ['voteUpdated' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post->load([
            'pollOptions',
            'user',
            'community',
            'images',
        ])->loadCount('comments')
          ->loadSum('votes', 'value');
    }

    /* ================= POLL VOTE ================= */
    public function votePoll(int $optionId)
    {
        if (!Auth::check()) return;

        $option = PollOption::find($optionId);
        if (!$option) return;

        // cari vote user di post ini
        $existingVote = PollVote::where('user_id', Auth::id())
            ->whereHas('pollOption', function ($q) use ($option) {
                $q->where('post_id', $option->post_id);
            })->first();

        // klik ulang → batal vote
        if ($existingVote && $existingVote->poll_option_id === $option->id) {
            $existingVote->delete();
            return;
        }

        // ganti vote
        if ($existingVote) {
            $existingVote->update([
                'poll_option_id' => $option->id,
            ]);
            return;
        }

        // vote baru
        PollVote::create([
            'user_id'        => Auth::id(),
            'poll_option_id' => $option->id,
        ]);
    }

    public function render()
    {
        return view('livewire.components.card');
    }
}
