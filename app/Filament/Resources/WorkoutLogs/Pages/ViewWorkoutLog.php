<?php

namespace App\Filament\Resources\WorkoutLogs\Pages;

use App\Filament\Resources\WorkoutLogs\WorkoutLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkoutLog extends ViewRecord
{
    protected static string $resource = WorkoutLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
