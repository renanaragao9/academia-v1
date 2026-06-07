<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Purchase\IndexPurchaseRequest;
use App\Http\Resources\Api\V1\Purchase\PurchaseResource;
use App\Services\Purchase\IndexPurchaseService;
use Illuminate\Http\JsonResponse;

class PurchaseController extends BaseController
{
    public function index(
        IndexPurchaseRequest $indexPurchaseRequest,
        IndexPurchaseService $indexPurchaseService
    ): JsonResponse {
        $data = $indexPurchaseRequest->validated();
        $purchases = $indexPurchaseService->run($data);

        if ($purchases === null) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno nao encontrado.'],
                message: 'Aluno nao encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: PurchaseResource::collection($purchases),
            message: 'Compras carregadas com sucesso.'
        );
    }
}
