<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            // relasi ke conversation
            'conversation_id' => Conversation::inRandomOrder()->first()->id,

            // pengirim pesan
            'user_id' => User::inRandomOrder()->first()->id,

            // isi pesan
            'body' => $this->faker->sentence(),

            // status dibaca / belum
            'is_read' => $this->faker->boolean(),
        ];
    }
}
