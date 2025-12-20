<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            // user yang vote
            $table->foreignId('post_id')->nullable()->constrained()->cascadeOnDelete(); 
            // vote ke post
            $table->foreignId('comment_id')->nullable()->constrained()->cascadeOnDelete(); 
            // vote ke comment
            $table->integer('value'); // +1 upvote, -1 downvote
            $table->timestamp('created_at')->useCurrent(); // waktu vote
            $table->index(['post_id','comment_id']); // index untuk query cepat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
