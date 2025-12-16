<?php

namespace Database\Factories;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoginLogFactory extends Factory
{
    protected $model = LoginLog::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'login_at' => now(),
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
        ];
    }
}
