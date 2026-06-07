<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\MealPlan\IndexMealPlanRequest;
use App\Http\Resources\Api\V1\MealPlan\MealPlanResource;
use App\Services\MealPlan\IndexMealPlanService;
use Illuminate\Http\JsonResponse;

class MealPlanController extends BaseController
{
    public function index(
        IndexMealPlanRequest $indexMealPlanRequest,
        IndexMealPlanService $indexMealPlanService
    ): JsonResponse {
        $data = $indexMealPlanRequest->validated();
        $mealPlans = $indexMealPlanService->run($data);

        if ($mealPlans === null) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno não encontrado.'],
                message: 'Aluno não encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: MealPlanResource::collection($mealPlans),
            message: 'Planos alimentares carregados com sucesso.'
        );
    }
}
