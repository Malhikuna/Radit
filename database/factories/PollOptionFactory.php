<?php

namespace Database\Factories;

use App\Models\PollOption;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PollOptionFactory extends Factory
{
    protected $model = PollOption::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'option_text' => $this->faker->word,
            'votes' => 0,
        ];
    }
}
