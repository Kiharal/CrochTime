<?php

use App\Models\Item;
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
        Schema::create('likes', function (Blueprint $table)
        {
            $table->id();
            $table->foreignIdFor(Item::class);
        });
        Schema::create('reviews', function (Blueprint $table)
        {
            $table->id();
            $table->integer('rating');
            $table->longText('comment');
            $table->foreignIdFor(Item::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('reviews');
        Schema::dropDatabaseIfExists('likes');
    }
};
