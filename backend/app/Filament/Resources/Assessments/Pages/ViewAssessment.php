<?php

namespace App\Filament\Resources\Assessments\Pages;

use App\Filament\Resources\Assessments\AssessmentResource;
use App\Models\Assessment;
use App\Services\Pdf\GenerateAssessmentPdfService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssessment extends ViewRecord
{
    protected static string $resource = AssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadPdf')
                ->label('Avaliação PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function (Assessment $record) {
                    $service = app(GenerateAssessmentPdfService::class);
                    $path = $service->run($record->student_id);

                    $slug = str($record->student->name)->slug()->value();

                    return response()->download($path, "avaliacoes-{$slug}.pdf")->deleteFileAfterSend();
                }),
            EditAction::make(),
        ];
    }
}
