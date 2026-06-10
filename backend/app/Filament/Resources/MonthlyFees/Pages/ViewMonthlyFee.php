<?php

namespace App\Filament\Resources\MonthlyFees\Pages;

use App\Filament\Resources\MonthlyFees\MonthlyFeeResource;
use App\Services\Pdf\GenerateMonthlyFeeReceiptService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMonthlyFee extends ViewRecord
{
    protected static string $resource = MonthlyFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    $service = app(GenerateMonthlyFeeReceiptService::class);
                    $path = $service->run($this->record);

                    return response()->download($path, "mensalidade-{$this->record->uuid}.pdf")->deleteFileAfterSend();
                }),
            EditAction::make(),
        ];
    }
}
