<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_fees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->date('date_payment')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('full_payment', 8, 2);
            $table->decimal('discount_payment', 8, 2)->default(0);
            $table->decimal('amount_paid', 8, 2)->nullable();
            $table->foreignId('student_id')->constrained('students')->restrictOnDelete();
            $table->foreignId('payment_type_id')->constrained('payment_types')->restrictOnDelete();
            $table->foreignId('plan_type_id')->constrained('plan_types')->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_fees');
    }
};
