<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('poll_options', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->cascadeOnDelete();
    $table->string('option_text');
    $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
    $table->timestamps();

    // mencegah user vote lebih dari 1 kali di post yang sama
    $table->unique(['post_id', 'user_id']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('poll_options');
    }
};
