<?php

namespace App\Models;

class PlanType extends BaseModel
{
    protected $table = 'plan_types';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
