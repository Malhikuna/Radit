<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $types = ['text','image','video','link','poll'];

        return [
            'user_id' => User::factory(),
            'community_id' => Community::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'type' => $this->faker->randomElement($types),
            'status' => 'published',
            'views' => $this->faker->numberBetween(0, 100),
        ];
    }
}
