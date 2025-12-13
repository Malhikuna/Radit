<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $communities = Community::all();

        foreach ($communities as $community) {
            $community->members()->attach(
                $users->random(rand(3, 8))->pluck('id'),
                ['role' => 'member', 'joined_at' => Carbon::now()]
            );
        }
    }
}
