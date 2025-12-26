<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Menjalankan seeder untuk tabel messages
     */
    public function run(): void
    {
        // Membuat 10 data pesan menggunakan MessageFactory
        Message::factory(10)->create();
    }
}
