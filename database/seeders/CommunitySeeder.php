<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        Community::factory(5)->create(); // buat 5 komunitas contoh
    }
}
