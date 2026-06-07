<?php

namespace App\Services\Purchase;

use App\Models\Sale;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class IndexPurchaseService
{
    public function run(array $data): ?Collection
    {
        $student = Student::query()
            ->where('code', $data['code'])
            ->when(
                ! empty($data['email']),
                fn ($query) => $query->where('email', $data['email'])
            )
            ->when(
                ! empty($data['phone']),
                fn ($query) => $query->where('phone', $data['phone'])
            )
            ->first();

        if (! $student) {
            return null;
        }

        return Sale::query()
            ->with(['saleItems.item'])
            ->where('student_id', $student->id)
            ->orderByDesc('date_sale')
            ->get();
    }
}
