<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Assessment\IndexAssessmentRequest;
use App\Http\Resources\Api\V1\Assessment\AssessmentResource;
use App\Services\Assessment\IndexAssessmentService;
use Illuminate\Http\JsonResponse;

class AssessmentController extends BaseController
{
    public function index(
        IndexAssessmentRequest $indexAssessmentRequest,
        IndexAssessmentService $indexAssessmentService
    ): JsonResponse {
        $data = $indexAssessmentRequest->validated();
        $assessments = $indexAssessmentService->run($data);

        if ($assessments === null) {
            return $this->errorResponse(
                errors: ['student' => 'Aluno não encontrado.'],
                message: 'Aluno não encontrado.',
                statusCode: 404
            );
        }

        return $this->successResponse(
            data: AssessmentResource::collection($assessments),
            message: 'Avaliações carregadas com sucesso.'
        );
    }
}
