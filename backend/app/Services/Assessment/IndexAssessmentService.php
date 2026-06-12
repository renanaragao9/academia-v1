<?php

namespace App\Services\Assessment;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class IndexAssessmentService
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

        return $student->assessments()
            ->with('items.measurementType')
            ->orderByDesc('created_at')
            ->get();
    }
}
