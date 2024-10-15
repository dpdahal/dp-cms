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
        Schema::create('gallery_settings', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_name');
            $table->integer('thumbnail_max_w')->default(0);
            $table->integer('thumbnail_max_h')->default(0);
            $table->boolean('corp_thumbnail')->default(false);
            $table->string('medium_name');
            $table->integer('medium_max_w')->default(0);
            $table->integer('medium_max_h')->default(0);
            $table->string('large_name');
            $table->integer('large_max_w')->default(0);
            $table->integer('large_max_h')->default(0);
            $table->boolean('upload_to')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_settings');
    }
};
