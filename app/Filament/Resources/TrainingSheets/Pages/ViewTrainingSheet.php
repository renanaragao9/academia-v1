<?php

namespace App\Filament\Resources\TrainingSheets\Pages;

use App\Filament\Resources\TrainingSheets\TrainingSheetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrainingSheet extends ViewRecord
{
    protected static string $resource = TrainingSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
