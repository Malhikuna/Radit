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
            'user_id' => rand(1, 20),       // asumsi user sudah ada
            'community_id' => rand(1, 5),  // asumsi community ada
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['published', 'draft']),
            'views' => $this->faker->numberBetween(0, 500),
        ];
    }
}
