<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('post_id')->constrained()->cascadeOnDelete(); 
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            
            $table->unsignedBigInteger('parent_id')->nullable(); 
            $table->foreign('parent_id')->references('id')->on('comments')->cascadeOnDelete();
            
            $table->text('content'); // isi comment
            $table->timestamps(); // created_at & updated_at
            $table->index('post_id'); // index untuk query cepat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
