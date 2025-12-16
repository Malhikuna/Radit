<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key auto-increment
            $table->string('name'); // nama user
            $table->string('email')->unique(); // email unik
            $table->string('password'); // password hash
            $table->string('role')->default('member'); // role user, default member
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users'); // hapus tabel jika rollback
    }
};
