<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_qrs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_id')
                ->constrained('class_sessions')
                ->cascadeOnDelete();

            $table->string('token')->unique();
            $table->dateTime('expired_at');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // index biar cepat
            $table->index('session_id');
            $table->index('token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_qrs');
    }
};
