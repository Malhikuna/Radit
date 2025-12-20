<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('community_members', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('community_id')->constrained()->cascadeOnDelete(); 
            // foreign key ke communities.id, hapus jika community dihapus
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            // foreign key ke users.id, hapus jika user dihapus
            $table->string('role')->default('member'); // role di komunitas
            $table->timestamp('joined_at')->useCurrent(); // waktu join
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('community_members');
    }
};
