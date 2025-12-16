<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => rand(1, 20),
            'community_id' => rand(1, 5),
            'title' => fake()->sentence(6),
            'content' => fake()->paragraphs(3, true),
            'status' => fake()->randomElement(['published', 'draft']),
            'views' => fake()->numberBetween(0, 500),

            // news
            'created_at' => fake()->dateTimeBetween('-7 days', '-1 minute'),
            'updated_at' => now(),
        ];
    }
}
