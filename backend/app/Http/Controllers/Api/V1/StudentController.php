<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Student\ShowStudentRequest;
use App\Http\Resources\Api\V1\Student\StudentResource;
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
}
