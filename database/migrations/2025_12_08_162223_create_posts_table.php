<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            // pemilik post
            $table->foreignId('community_id')->constrained()->cascadeOnDelete(); 
            // komunitas post
            $table->string('title'); // judul post
            $table->text('content')->nullable(); // isi teks (text post)
            $table->string('url')->nullable();   // link post (link post)
            $table->enum('type', ['text','image','video','link','poll'])->default('text'); 
            // tipe post
            $table->enum('status', ['published','removed','locked'])->default('published'); 
            // status post
            $table->integer('views')->default(0); // jumlah view
            $table->timestamps(); // created_at & updated_at
            $table->index(['title','type','status']); // index untuk search
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};