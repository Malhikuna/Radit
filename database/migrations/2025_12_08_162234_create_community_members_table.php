<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('community_members', function (Blueprint $table) {
            $table->id();
            $table->integer('community_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('role')->default('member');
            $table->dateTime('joined_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('community_members');
    }
};
