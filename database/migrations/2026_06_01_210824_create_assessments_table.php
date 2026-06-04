<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->date('assessed_at');
            $table->decimal('value', 8, 2);
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('measurement_type_id')->constrained('measurement_types')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('student_id');
            $table->index('measurement_type_id');
            $table->index('user_id');
            $table->index('deleted_at');
            $table->index(['student_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
