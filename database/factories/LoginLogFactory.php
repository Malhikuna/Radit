<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoginLog>
 */
class LoginLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? 1,
            // 'login_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            // 'ip_address' => $this->faker->ipv4(),
            // 'user_agent' => $this->faker->userAgent(),
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
        ];
    }
}
