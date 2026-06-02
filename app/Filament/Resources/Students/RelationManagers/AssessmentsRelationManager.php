<?php

namespace App\Filament\Resources\Students\RelationManagers;

use App\Filament\Resources\Assessments\AssessmentResource;
use App\Models\Assessment;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AssessmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assessments';

    protected static ?string $title = 'Avaliações';

    public function form(Schema $schema): Schema
    {
        $studentId = $this->getOwnerRecord()->getKey();

        return $schema
            ->columns(2)
            ->components([
                Select::make('measurement_type_id')
                    ->label('Tipo de Medição')
                    ->relationship(
                        name: 'measurementType',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query
                            ->whereNotIn('id',
                                Assessment::where('student_id', $studentId)
                                    ->when(
                                        $this->getRecord()?->getKey(),
                                        fn ($q, $id) => $q->where('id', '!=', $id)
                                    )
                                    ->pluck('measurement_type_id')
                            )
                            ->orderBy('name'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->step(0.01)
                    ->required(),

                DatePicker::make('assessed_at')
                    ->label('Data da Avaliação')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->required(),

                Textarea::make('notes')
                    ->label('Observações')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('measurementType.name')
                    ->label('Tipo de Medição')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('assessed_at')
                    ->label('Data da Avaliação')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Avaliador')
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('assessed_at', 'desc')
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
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
