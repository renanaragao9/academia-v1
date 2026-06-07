<?php

namespace App\Services\MealPlan;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

class IndexMealPlanService
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

        return $student->mealPlans()
            ->with([
                'meals.mealType',
                'meals.foods.food',
            ])
            ->where('is_active', true)
            ->orderByDesc('start_date')
            ->get();
    }
}
