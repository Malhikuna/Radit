<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambahkan kolom gambar ke tabel communities
        Schema::table('communities', function (Blueprint $table) {
            $table->string('profile_image')->nullable(); // foto profil komunitas
            $table->string('banner_image')->nullable();  // banner komunitas
        });
    }

    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'banner_image']);
        });
    }
};
