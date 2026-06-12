<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Filament\Resources\Assessments\AssessmentResource;
use App\Models\Assessment;
use App\Services\Pdf\GenerateAssessmentPdfService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssessmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assessments';

    protected static ?string $relatedResource = AssessmentResource::class;

    protected static ?string $title = 'Avaliações';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Avaliação')
                    ->searchable()
                    ->sortable(),

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
                    ->label('Ativo')
                    ->boolean(),

                TextColumn::make('items_total')
                    ->label('Medições')
                    ->state(fn (Assessment $record): int => $record->items()->count()),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Action::make('createAssessment')
                    ->label('Nova Avaliação')
                    ->color('primary')
                    ->url(fn () => AssessmentResource::getUrl('create', [
                        'student_id' => $this->getOwnerRecord()->getKey(),
                    ])),
            ])
            ->recordActions([
                ViewAction::make(),
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
                DeleteAction::make(),
            ]);
    }
}
