<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    /**
     * Menjalankan seeder untuk tabel conversations
     */
    public function run(): void
    {
        // Membuat 5 data conversation menggunakan factory
        Conversation::factory(5)->create();
    }
}
