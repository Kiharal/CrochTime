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
        Schema::create('color_items', function (Blueprint $table) {
            $table->id();
            $table->string('color_name', 50);
            $table->string('image_hash', 20)->unique();
            $table->string('image_path', 200)->unique();
            $table->unsignedTinyInteger('r');
            $table->unsignedTinyInteger('g');
            $table->unsignedTinyInteger('b');
            $table->string('hex', 7);
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_items');
    }
};
