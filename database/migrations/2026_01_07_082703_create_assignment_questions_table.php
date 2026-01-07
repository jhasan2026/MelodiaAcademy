<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assignment_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();

            $table->enum('type', ['mcq', 'tf', 'short']);
            $table->text('prompt');
            $table->json('options')->nullable();
            $table->string('correct_answer')->nullable();
            $table->unsignedInteger('points')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignment_questions');
    }
};
