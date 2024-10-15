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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_author')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('album_id')->constrained('albums')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('post_date')->default(now());
            $table->string('file_name');
            $table->string('title')->nullable();
            $table->string('alternative_text')->nullable();
            $table->string('caption')->nullable();
            $table->string('description')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('url')->nullable();
            $table->string('edit_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
