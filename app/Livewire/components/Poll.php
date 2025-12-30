<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Poll extends Component
{
    public Post $post;

    public function vote($optionId)
    {
        if (!auth()->check()) return;

        $existing = PollVote::where('user_id', auth()->id())
            ->whereHas('option', fn ($q) =>
                $q->where('post_id', $this->post->id)
            )->first();

        if ($existing && $existing->poll_option_id == $optionId) {
            $existing->delete();
            return;
        }

        if ($existing) $existing->delete();

        PollVote::create([
            'user_id' => auth()->id(),
            'poll_option_id' => $optionId,
        ]);
    }

    public function render()
    {
        return view('livewire.components.poll');
    }
}
