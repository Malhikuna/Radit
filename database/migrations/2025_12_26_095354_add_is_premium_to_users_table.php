<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
 public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'premium_expired_at')) {
            $table->timestamp('premium_expired_at')->nullable();
        }
        if (!Schema::hasColumn('users', 'is_premium')) {
            $table->boolean('is_premium')->default(false);
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['is_premium', 'premium_expired_at']);
    });
}

};
