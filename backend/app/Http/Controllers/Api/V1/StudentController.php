<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Student\ShowStudentRequest;
use App\Http\Resources\Api\V1\Student\StudentResource;
use App\Models\Sale;
use App\Services\Student\ShowStudentService;
use Illuminate\Http\JsonResponse;

class StudentController extends BaseController
{
    public function show(
        ShowStudentRequest $showStudentRequest,
        ShowStudentService $showStudentService
    ): JsonResponse {
        $data = $showStudentRequest->validated();
        $student = $showStudentService->run($data);

        if (! $student) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno não encontrado.'],
                message: 'Aluno não encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: new StudentResource($student),
            message: 'Aluno encontrado com sucesso.'
        );
    }

    public function dashboard(Student $student): JsonResponse
    {
        $student->load([
            'trainingSheets' => fn ($query) => $query->where('is_active', true)->latest()->limit(1),
            'assessments' => fn ($query) => $query->latest()->limit(3),
            'mealPlans' => fn ($query) => $query->where('is_active', true)->latest()->limit(1),
            'monthlyFees' => fn ($query) => $query->latest()->limit(3),
        ]);

        $purchasesCount = $student->hasMany(Sale::class)->count();

        return $this->successResponse(
            data: [
                'student' => new StudentResource($student),
                'shortcuts' => [
                    'training_sheets' => [
                        'count' => $student->trainingSheets->count(),
                        'active' => $student->trainingSheets->first(),
                    ],
                    'assessments' => [
                        'count' => $student->assessments()->count(),
                        'latest' => $student->assessments,
                    ],
                    'meal_plans' => [
                        'count' => $student->mealPlans->count(),
                        'active' => $student->mealPlans->first(),
                    ],
                    'monthly_fees' => [
                        'count' => $student->monthlyFees()->count(),
                        'latest' => $student->monthlyFees,
                    ],
                    'purchases' => [
                        'count' => $purchasesCount,
                    ],
                ],
            ],
            message: 'Dashboard carregado com sucesso.'
        );
    }
}
