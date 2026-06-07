<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\MonthlyFee\IndexMonthlyFeeRequest;
use App\Http\Resources\Api\V1\MonthlyFee\MonthlyFeeResource;
use App\Services\MonthlyFee\IndexMonthlyFeeService;
use Illuminate\Http\JsonResponse;

class MonthlyFeeController extends BaseController
{
    public function index(
        IndexMonthlyFeeRequest $indexMonthlyFeeRequest,
        IndexMonthlyFeeService $indexMonthlyFeeService
    ): JsonResponse {
        $data = $indexMonthlyFeeRequest->validated();
        $monthlyFees = $indexMonthlyFeeService->run($data);

        if ($monthlyFees === null) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno nao encontrado.'],
                message: 'Aluno nao encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: MonthlyFeeResource::collection($monthlyFees),
            message: 'Mensalidades carregadas com sucesso.'
        );
    }
}
