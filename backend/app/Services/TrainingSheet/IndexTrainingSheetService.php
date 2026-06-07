<?php

namespace App\Services\TrainingSheet;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class IndexTrainingSheetService
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

        return $student->trainingSheets()
            ->with([
                'divisions.trainingDivision',
                'divisions.exercises.exercise',
                'workoutLogs.sheetDivision.trainingDivision',
                'workoutLogs.validator',
                'workoutLogs.logExercises.exercise',
            ])
            ->where('is_active', true)
            ->orderByDesc('start_date')
            ->get();
    }
}
