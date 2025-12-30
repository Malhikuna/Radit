<?php

namespace Database\Factories;

use App\Models\PollOption;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PollOptionFactory extends Factory
{
    protected $model = PollOption::class;

    public function definition(): array
    {
        return [
            'post_id'     => Post::factory(),
            'option_text' => $this->faker->words(2, true),
            'user_id'     => null,
        ];
    }
}
