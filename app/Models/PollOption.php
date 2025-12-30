<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{

public $pollOptions;
public $hasVoted = false;
public $userVotedOptionId = null;

public function loadPoll()
{
    $this->pollOptions = PollOption::where('post_id', $this->post->id)
        ->select('id', 'option_text', 'post_id')
        ->withCount([
            'as votes_count' => function ($q) {
                $q->whereNotNull('user_id');
            }
        ])
        ->get();

    if (Auth::check()) {
        $vote = PollOption::where('post_id', $this->post->id)
            ->where('user_id', Auth::id())
            ->first();

        $this->hasVoted = (bool) $vote;
        $this->userVotedOptionId = $vote?->id;
    }
}

    protected $fillable = [
        'post_id',
        'option_text',
        'votes',
    ];

        public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
