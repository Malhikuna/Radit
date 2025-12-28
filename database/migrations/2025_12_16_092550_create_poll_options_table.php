<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Membuat tabel poll_options
        Schema::create('poll_options', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('post_id')->constrained()->cascadeOnDelete(); 
            // foreign key ke posts.id, jika post dihapus → opsi ikut terhapus
            $table->string('option_text'); // isi opsi poll
            $table->integer('votes')->default(0); // jumlah vote awal = 0
        });
    }

    public function down(): void
    {
        // Hapus tabel saat rollback
        Schema::dropIfExists('poll_options');
    }
};
