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
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();

            // 0=Sunday ... 6=Saturday (matches many calendar libs)
            $table->unsignedTinyInteger('day_of_week'); // 0..6

            $table->time('start_time');
            $table->time('end_time');

            // Optional range limits for recurring schedule
            $table->date('starts_on')->nullable();
            $table->date('ends_on')->nullable();

            $table->string('timezone')->nullable(); // if per-slot differs
            $table->string('note')->nullable();

            $table->timestamps();

            $table->index(['course_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
    }
};
