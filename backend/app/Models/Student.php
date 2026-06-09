<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;

class Student extends BaseModel
{
    use Notifiable;
    protected $table = 'students';

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'image_path',
        'gender',
        'color',
        'status',
        'birth_date',
        'entry_date',
        'last_access_at',
        'weight',
        'height',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'entry_date' => 'date',
        'last_access_at' => 'datetime',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public const GENDERS = [
        'male' => 'Masculino',
        'female' => 'Feminino',
        'other' => 'Outro',
    ];

    public const STATUSES = [
        'active' => 'Ativo',
        'inactive' => 'Inativo',
        'suspended' => 'Suspenso',
        'pending' => 'Pendente',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingSheets(): HasMany
    {
        return $this->hasMany(TrainingSheet::class);
    }

    public function workoutLogs(): HasMany
    {
        return $this->hasMany(WorkoutLog::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function mealPlans(): HasMany
    {
        return $this->hasMany(MealPlan::class);
    }

    public function monthlyFees(): HasMany
    {
        return $this->hasMany(MonthlyFee::class);
    }

    public function bookingStudents(): HasMany
    {
        return $this->hasMany(BookingStudent::class);
    }

    public function bookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, BookingStudent::class);
    }
}
