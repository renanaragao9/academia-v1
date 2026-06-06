<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends BaseModel
{
    use SoftDeletes;

    protected $table = 'assessments';

    protected $fillable = [
        'student_id',
        'measurement_type_id',
        'user_id',
        'value',
        'assessed_at',
        'notes',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'assessed_at' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
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
