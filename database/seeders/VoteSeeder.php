<?php

namespace Database\Seeders;

use App\Models\Vote;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        for ($i = 0; $i < 100; $i++) {
            Vote::create([
                'user_id' => $users->random()->id,
                'post_id' => rand(0, 1) ? $posts->random()->id : null,
                'comment_id' => rand(0, 1) ? $comments->random()->id : null,
                'value' => rand(0, 1) ? 1 : -1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
