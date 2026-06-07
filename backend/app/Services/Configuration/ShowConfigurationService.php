<?php

namespace App\Services\Configuration;

use App\Models\Configuration;

class ShowConfigurationService
{
    public function run(): Configuration
    {
        return Configuration::where('is_active', true)->first();
    }
}
