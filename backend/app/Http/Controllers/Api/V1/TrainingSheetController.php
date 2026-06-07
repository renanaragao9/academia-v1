<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\TrainingSheet\IndexTrainingSheetRequest;
use App\Http\Resources\Api\V1\TrainingSheet\TrainingSheetResource;
use App\Services\TrainingSheet\IndexTrainingSheetService;
use Illuminate\Http\JsonResponse;

class TrainingSheetController extends BaseController
{
    public function index(
        IndexTrainingSheetRequest $indexTrainingSheetRequest,
        IndexTrainingSheetService $indexTrainingSheetService
    ): JsonResponse {
        $data = $indexTrainingSheetRequest->validated();
        $sheets = $indexTrainingSheetService->run($data);

        if ($sheets === null) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno não encontrado.'],
                message: 'Aluno não encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: TrainingSheetResource::collection($sheets),
            message: 'Fichas de treino carregadas com sucesso.'
        );
    }
}
