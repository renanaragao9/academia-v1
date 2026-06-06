<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends BaseModel
{
    protected $table = 'exercises';

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'gif_path',
        'video_path',
        'is_active',
        'equipment_type_id',
        'muscle_group_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class);
    }
}
