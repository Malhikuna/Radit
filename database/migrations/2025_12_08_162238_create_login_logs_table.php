<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            // foreign key ke users.id, jika user dihapus → log ikut terhapus
            $table->timestamp('login_at')->useCurrent(); // waktu login
            $table->string('ip_address')->nullable(); // IP login, boleh kosong
            $table->text('user_agent')->nullable(); // user agent browser / device
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_logs'); // hapus tabel
    }
};
