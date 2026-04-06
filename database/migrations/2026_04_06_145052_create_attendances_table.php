<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('session_id')
                ->constrained('class_sessions')
                ->cascadeOnDelete();

            $table->foreignId('session_qr_id')
                ->constrained('session_qrs')
                ->cascadeOnDelete();

            $table->enum('status', ['present', 'sick', 'permit', 'absent'])
                ->default('present');

            $table->dateTime('scanned_at');

            $table->timestamps();

            // 🔥 anti double absen
            $table->unique(['user_id', 'session_id']);

            // index
            $table->index('session_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
