<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            if (rand(0, 1)) { // 50% chance ada gambar
                Image::create([
                    'post_id' => $post->id,
                    'file_path' => 'images/sample' . rand(1, 5) . '.jpg',
                    'created_at' => now(),
                ]);
            }
        }
    }
}
