<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'name',
        'cnpj',
        'email',
        'phone',
        'whatsapp',
        'emergency_phone',
        'zip_code',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'website',
        'instagram',
        'facebook',
        'youtube',
        'logo',
        'favicon',
        'description',
        'notes',
        'opening_hours',
        'opening_time',
        'closing_time',
        'default_training_duration_days',
        'default_assessment_duration_days',
        'max_workouts_per_student',
        'allow_student_registration',
        'allow_online_assessments',
        'send_email_notifications',
        'send_whatsapp_notifications',
        'is_active',
    ];

    protected $casts = [
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
        'allow_student_registration' => 'boolean',
        'allow_online_assessments' => 'boolean',
        'send_email_notifications' => 'boolean',
        'send_whatsapp_notifications' => 'boolean',
        'is_active' => 'boolean',
    ];

    public $timestamps = true;
}
