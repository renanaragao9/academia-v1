<?php

namespace App\Filament\Resources\TrainingSheets\Tables;

use App\Models\TrainingSheet;
use App\Services\Pdf\GenerateTrainingSheetPdfService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TrainingSheetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Ficha')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Fim')
                    ->date('d/m/Y')
                    ->placeholder('-')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean(),
                TextColumn::make('student.name')
                    ->label('Aluno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Criado por')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updater.name')
                    ->label('Atualizado por')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Excluído em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make()
                    ->label('Registros excluídos'),
            ])
            ->recordActions([
                Action::make('downloadPdf')
                    ->label('Ficha PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (TrainingSheet $record) {
                        $service = app(GenerateTrainingSheetPdfService::class);
                        $path = $service->run($record);

                        return response()->download($path, "ficha-{$record->id}.pdf")->deleteFileAfterSend();
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
