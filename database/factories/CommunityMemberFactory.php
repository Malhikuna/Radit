<?php

namespace Database\Factories;

use App\Models\CommunityMember;
use App\Models\User;
use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityMemberFactory extends Factory
{
    protected $model = CommunityMember::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'community_id' => Community::factory(),
            'role' => 'member',
            'joined_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
