<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Community;

// class PostSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $users = User::all();
//         $communities = Community::all();

//         // safety check
//         if ($users->isEmpty()) {
//             return;
//         }

//         // Buat 10 post random
//         Post::factory()->count(10)->make()->each(function ($post) use ($users, $communities) {
//             $post->user_id = $users->random()->id;
//             $post->community_id = $communities->isNotEmpty()
//                 ? $communities->random()->id
//                 : null;

//             $post->save();
//         });
//     }
// }

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $communities = Community::all();

        if ($users->isEmpty()) {
            return;
        }

        Post::factory()
            ->count(10)
            ->make()
            ->each(function ($post) use ($users, $communities) {
                $post->user_id = $users->random()->id;
                $post->community_id = $communities->isNotEmpty()
                    ? $communities->random()->id
                    : null;

                $post->save();
            });
    }
}
