<?php

namespace App\Filament\Resources\WorkoutLogs\Pages;

use App\Filament\Resources\WorkoutLogs\Schemas\WorkoutLogInfolist;
use App\Filament\Resources\WorkoutLogs\WorkoutLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewWorkoutLog extends ViewRecord
{
    protected static string $resource = WorkoutLogResource::class;

    public function getTitle(): string
    {
        return 'Visualizar Registro de Treino';
    }

    public function infolist(Schema $schema): Schema
    {
        return WorkoutLogInfolist::configure($schema);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
