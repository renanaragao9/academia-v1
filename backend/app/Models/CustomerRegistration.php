<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Support\LogOptions;

class CustomerRegistration extends BaseModel
{
    protected $table = 'customer_registrations';

    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'email',
        'message',
        'plan_type_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Registro de cliente criado',
                'updated' => 'Registro de cliente atualizado',
                'deleted' => 'Registro de cliente excluído',
                default => $eventName,
            });
    }

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }
}
