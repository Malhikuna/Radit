<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;
use App\Models\User;

class CommunityMemberSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $communities = Community::all();

        foreach ($communities as $community) {
            // setiap komunitas isi 3 user random
            $randomUsers = $users->random(3);
            foreach ($randomUsers as $user) {
                $community->members()->attach($user->id, [
                    'role' => 'member',
                    'joined_at' => now()
                ]);
            }
        }
    }
}
