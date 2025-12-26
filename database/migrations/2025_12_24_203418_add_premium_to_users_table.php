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
    Schema::table('users', function ($table) {
        $table->boolean('is_premium')->default(false);
        $table->timestamp('premium_expired_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function ($table) {
        $table->dropColumn(['is_premium', 'premium_expired_at']);
    });
}

};
