<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CommunitySeeder::class,
            CommunityMemberSeeder::class,
            PostSeeder::class,
            ImageSeeder::class,
            CommentSeeder::class,
            VoteSeeder::class,
            LoginLogSeeder::class,
            PollOptionSeeder::class,
        ]);
        // User::factory(10)->create();

        //     $this->call([
        //     PostSeeder::class,
        // ]);

        // $this->call([
        // UserSeeder::class,
        //  ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
