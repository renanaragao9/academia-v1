<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Support\LogOptions;

class Food extends BaseModel
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'image_path',
        'link_url',
        'is_active',
        'food_type_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Alimento criado',
                'updated' => 'Alimento editado',
                'deleted' => 'Alimento excluído',
                default => $eventName,
            });
    }

    public function foodType(): BelongsTo
    {
        return $this->belongsTo(FoodType::class);
    }
}
