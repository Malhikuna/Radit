<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->dateTime('login_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
