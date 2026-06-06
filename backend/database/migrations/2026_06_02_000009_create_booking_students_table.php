<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();

            // Um aluno só pode ter uma reserva (unique constraint)
            $table->unique(['booking_id', 'student_id']);
            // Índice para melhor performance
            $table->index('student_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_students');
    }
};
