<?php

namespace App\Filament\Resources\MonthlyFees\Tables;

use App\Services\Pdf\GenerateMonthlyFeeReceiptService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MonthlyFeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('planType.name')
                    ->label('Plano')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('paymentType.name')
                    ->label('Forma de Pagamento')
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Fim')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('date_payment')
                    ->label('Pagamento')
                    ->date('d/m/Y')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('full_payment')
                    ->label('Valor do Plano')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('discount_payment')
                    ->label('Desconto')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('amount_paid')
                    ->label('Valor Pago')
                    ->money('BRL')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Responsável')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                TrashedFilter::make()
                    ->label('Registros excluídos'),
            ])
            ->recordActions([
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (MonthlyFee $record) {
                        $service = app(GenerateMonthlyFeeReceiptService::class);
                        $path = $service->run($record);

                        return response()->download($path, "mensalidade-{$record->uuid}.pdf")->deleteFileAfterSend();
                    }),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
