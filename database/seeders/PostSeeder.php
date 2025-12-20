<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;        // 🔴 WAJIB
use App\Models\Community;  // 🔴 WAJIB

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $communities = Community::all();

        foreach (range(1, 20) as $i) {
            $type = fake()->randomElement(['text', 'link']);

            Post::create([
                'user_id' => $users->random()->id,
                'community_id' => $communities->random()->id,
                'title' => fake()->sentence(),
                'content' => $type === 'text' ? fake()->paragraph(4) : null,
                'url' => $type === 'link' ? fake()->url() : null,
                'type' => $type,
                'status' => 'published',
                'views' => fake()->numberBetween(0, 500),
            ]);
        }
    }
}
