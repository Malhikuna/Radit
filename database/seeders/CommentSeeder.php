<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        Comment::factory()->count(50)->create([
            'user_id'   => fn() => $users->random()->id,
            'post_id'   => fn() => $posts->random()->id,
            'parent_id' => null,
            'content'   => fake()->paragraph(),
        ]);
    }
}
