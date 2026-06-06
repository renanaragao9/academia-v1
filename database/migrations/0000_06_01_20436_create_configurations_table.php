<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('opening_hours')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->unsignedInteger('default_training_duration_days')->default(30);
            $table->unsignedInteger('default_assessment_duration_days')->default(90);
            $table->unsignedInteger('max_workouts_per_student')->nullable();
            $table->boolean('allow_student_registration')->default(true);
            $table->boolean('allow_online_assessments')->default(true);
            $table->boolean('send_email_notifications')->default(true);
            $table->boolean('send_whatsapp_notifications')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
