<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentItem extends Model
{
    use SoftDeletes;

    protected $table = 'assessment_items';

    protected $fillable = [
        'assessment_id',
        'measurement_type_id',
        'value',
        'unit',
        'notes',
        'assessed_at',
        'user_id',
        'order',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'unit' => 'string',
        'assessed_at' => 'date',
        'order' => 'integer',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function measurementType(): BelongsTo
    {
        return $this->belongsTo(MeasurementType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
