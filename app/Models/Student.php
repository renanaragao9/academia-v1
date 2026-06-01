<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends BaseModel
{
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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'birth_date' => 'date',
        'entry_date' => 'date',
        'last_access_at' => 'datetime',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
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

    public function trainingSheets(): HasMany
    {
        return $this->hasMany(TrainingSheet::class);
    }

    public function workoutLogs(): HasMany
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
