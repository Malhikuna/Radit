<?php

namespace Database\Factories;

use App\Models\Vote;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'comment_id' => null,
            'value' => $this->faker->randomElement([-1,1]),
        ];
    }
}
