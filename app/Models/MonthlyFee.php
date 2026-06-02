<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\Activitylog\Support\LogOptions;

class MonthlyFee extends BaseModel
{
    protected $table = 'monthly_fees';

    protected $fillable = [
        'uuid',
        'date_payment',
        'start_date',
        'end_date',
        'full_payment',
        'discount_payment',
        'student_id',
        'payment_type_id',
        'plan_type_id',
        'user_id',
    ];

    protected $casts = [
        'date_payment' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'full_payment' => 'decimal:2',
        'discount_payment' => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model): void {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Mensalidade registrada',
                'updated' => 'Mensalidade atualizada',
                'deleted' => 'Mensalidade excluída',
                default => $eventName,
            });
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Valor final após desconto */
    public function getFinalPaymentAttribute(): float
    {
        return (float) $this->full_payment - (float) $this->discount_payment;
    }
}
