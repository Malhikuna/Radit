<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use App\Models\PollVote;

class Poll extends Component
{
    public Post $post;

    public function votePoll(int $optionId)
    {
        if (!auth()->check()) return;

        $existing = PollVote::where('user_id', auth()->id())
            ->whereHas('pollOption', fn ($q) =>
                $q->where('post_id', $this->post->id)
            )->first();

        if ($existing && $existing->poll_option_id === $optionId) {
            $existing->delete();
        } else {
            if ($existing) $existing->delete();

            PollVote::create([
                'user_id' => auth()->id(),
                'poll_option_id' => $optionId,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.components.poll', [
            'userVote' => auth()->check()
                ? PollVote::where('user_id', auth()->id())
                    ->whereHas('pollOption', fn ($q) =>
                        $q->where('post_id', $this->post->id)
                    )->first()
                : null,
            'totalVotes' => max(
                $this->post->pollOptions->sum(fn ($o) => $o->votes()->count()),
                1
            ),
        ]);
    }
}