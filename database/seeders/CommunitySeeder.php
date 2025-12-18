<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

class CommunitySeeder extends Seeder
{
public function run(): void
    {
        $names = [
            'Laravel',
            'WebDev',
            'Programming',
            'Design',
            'Gaming'
        ];

        foreach ($names as $name) {
            Community::create([
                'name' => $name,
                'description' => "Community about $name",
                'icon' => null,
            ]);
        }
    }
}
