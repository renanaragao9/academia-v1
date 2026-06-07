<?php

namespace App\Services\TrainingSheet;

use App\Models\TrainingSheet;

class IndexTrainingSheetService
{
    public function run(array $data): ?TrainingSheet
    {
        return TrainingSheet::query()
            ->where('code', $data['code'])
            ->when(
                ! empty($data['email']),
                fn ($query) => $query->where('email', $data['email'])
            )
            ->when(
                ! empty($data['phone']),
                fn ($query) => $query->where('phone', $data['phone'])
            )
            ->first();
    }
}
