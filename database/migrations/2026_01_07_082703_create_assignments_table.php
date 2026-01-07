<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lesson_id')
                ->constrained('lesson_materials')
                ->cascadeOnDelete();

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            $table->enum('type', ['quiz', 'audio']);

            $table->boolean('is_published')->default(false);
            $table->timestamp('due_at')->nullable();
            $table->boolean('allow_late')->default(false);
            $table->boolean('allow_resubmit')->default(false);
            $table->unsignedInteger('max_score')->default(100);

            // quiz settings
            $table->unsignedInteger('time_limit_minutes')->nullable();
            $table->unsignedInteger('attempt_limit')->nullable();
            $table->boolean('auto_grade')->default(true);

            // audio settings
            $table->unsignedInteger('max_file_mb')->default(30);
            $table->unsignedInteger('max_duration_seconds')->nullable();
            $table->json('allowed_mimes')->nullable();

            $table->timestamps();
            $table->index(['lesson_id', 'type', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
