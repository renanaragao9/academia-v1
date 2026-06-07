<?php

namespace App\Services\MonthlyFee;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class IndexMonthlyFeeService
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

        return $student->monthlyFees()
            ->with(['planType', 'paymentType'])
            ->orderByDesc('start_date')
            ->get();
    }
}
