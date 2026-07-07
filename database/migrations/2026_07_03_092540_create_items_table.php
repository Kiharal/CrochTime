<?php

use App\Models\User;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            #ID FOR BUSINESS OWNER(i.e. CROCHETER)
            $table->foreignIdFor(User::class);
            $table->longText("description");
            $table->string("image_path")->nullable();
            $table->unsignedBigInteger("image_height");
            $table->unsignedBigInteger("image_width");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
