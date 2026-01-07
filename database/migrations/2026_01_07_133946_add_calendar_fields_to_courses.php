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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('calendar_color')->nullable()->after('room_number');   // e.g. "#3b82f6"
            $table->string('timezone')->nullable()->after('calendar_color');      // e.g. "Asia/Dhaka"
            $table->string('meeting_link')->nullable()->after('timezone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['calendar_color', 'timezone', 'meeting_link']);
        });
    }
};
