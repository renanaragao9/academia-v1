<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateConfigurationRequest;
use App\Http\Resources\Api\V1\ConfigurationResource;
use App\Services\ConfigurationService;
use Illuminate\Http\JsonResponse;

class ConfigurationController extends Controller
{
    public function __construct(
        private readonly ConfigurationService $service,
    ) {}

    /**
     * Retorna a configuração ativa da academia.
     *
     * GET /api/v1/configuration
     */
    public function show(): JsonResponse
    {
        $configuration = $this->service->getActive();

        if (! $configuration) {
            return response()->json([
                'message' => 'Nenhuma configuração encontrada.',
            ], 404);
        }

        return response()->json([
            'data' => new ConfigurationResource($configuration),
        ]);
    }

    /**
     * Atualiza ou cria a configuração da academia.
     *
     * PUT /api/v1/configuration
     */
    public function update(UpdateConfigurationRequest $request): JsonResponse
    {
        $configuration = $this->service->updateOrCreate($request->validated());

        return response()->json([
            'message' => 'Configuração atualizada com sucesso.',
            'data'    => new ConfigurationResource($configuration),
        ]);
    }
}
