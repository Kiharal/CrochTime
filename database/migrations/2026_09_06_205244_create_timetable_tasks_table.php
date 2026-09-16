<?php

use App\Models\Task;
use App\Models\Timetable;
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
        Schema::create('timetable_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Timetable::class);
            $table->foreignIdFor(Task::class);
            $table->boolean('is_extra');
            $table->integer('time_assigned');
            $table->enum('status', ['completed', 'pending', 'processing', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable_tasks');
    }
};
