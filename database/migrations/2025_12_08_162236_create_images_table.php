<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // primary key
            $table->foreignId('post_id')->constrained()->cascadeOnDelete(); 
            // post terkait
            $table->string('file_path'); // path file
            $table->enum('type', ['image','video'])->default('image'); // tipe media
            $table->timestamp('created_at')->useCurrent(); // waktu upload
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
