<?php

namespace App\Services;

use App\Models\Configuration;

class ConfigurationService
{
    /**
     * Retorna a configuração ativa da academia.
     * Como existe apenas um registro de configuração, busca o primeiro ativo.
     */
    public function getActive(): ?Configuration
    {
        return Configuration::where('is_active', true)->first();
    }

    /**
     * Atualiza ou cria a configuração da academia.
     * Garante que exista sempre apenas um registro ativo.
     */
    public function updateOrCreate(array $data): Configuration
    {
        $configuration = Configuration::where('is_active', true)->first()
            ?? Configuration::first();

        if ($configuration) {
            $configuration->update($data);
            return $configuration->fresh();
        }

        return Configuration::create(array_merge($data, ['is_active' => true]));
    }
}
