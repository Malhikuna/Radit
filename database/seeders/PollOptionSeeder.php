<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PollOption;

class PollOptionSeeder extends Seeder
{
    public function run(): void
    {
        $pollPosts = Post::where('type', 'poll')->take(5)->get();

        foreach ($pollPosts as $post) {
            PollOption::factory()
                ->count(3)
                ->create([
                    'post_id' => $post->id,
                    'user_id' => null, // template opsi
                ]);
        }
    }
}
