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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger("duration_week");
            $table->string("instrument_name");
            $table->string('instrument_image')->nullable();
            $table->float("rating")->default(0);
            $table->unsignedInteger("payment");
            $table->unsignedInteger("room_number")->nullable();
            $table->enum("course_level",['beginner','intermediate','advanced']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
