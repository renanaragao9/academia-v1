<?php

namespace App\Filament\Resources\TrainingSheets\Pages;

use App\Filament\Resources\TrainingSheets\TrainingSheetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewTrainingSheet extends ViewRecord
{
    protected static string $resource = TrainingSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getFooter(): ?View
    {
        return view('filament.training-sheet.floating-nav');
    }
}
