<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Support\LogOptions;

class BookingStudent extends BaseModel
{
    protected $table = 'booking_students';

    protected $fillable = [
        'booking_id',
        'student_id',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Aluno adicionado à reserva',
                'updated' => 'Registro de aluno em reserva atualizado',
                'deleted' => 'Aluno removido da reserva',
                default => $eventName,
            });
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
