<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Primary key untuk setiap pesan
            $table->foreignId('conversation_id')->constrained()->cascadeOnDelete(); // Relasi ke tabel conversations (pesan milik percakapan mana)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // User yang mengirim pesan
            $table->text('body'); // Isi pesan chat
            $table->boolean('is_read')->default(false);  // Status pesan: sudah dibaca atau belum
            $table->timestamps();  // Waktu pesan dibuat & diupdate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
