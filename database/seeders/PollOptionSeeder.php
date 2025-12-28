<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PollOption;
use App\Models\Post;

class PollOptionSeeder extends Seeder
{
    public function run(): void
    {
        // ambil 5 post tipe poll
        $pollPosts = Post::where('type','poll')->take(5)->get();

        foreach($pollPosts as $post){
            PollOption::factory(3)->create(['post_id' => $post->id]);
        }
    }
}
