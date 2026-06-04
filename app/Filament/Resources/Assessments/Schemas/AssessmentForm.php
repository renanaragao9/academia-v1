<?php

namespace App\Filament\Resources\Assessments\Schemas;

use App\Models\Assessment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class AssessmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('student_id')
                    ->label('Aluno')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),

                Select::make('measurement_type_id')
                    ->label('Tipo de Medição')
                    ->relationship(
                        name: 'measurementType',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query, Get $get) => $query
                            ->when(
                                $get('student_id'),
                                fn (Builder $q, $studentId) => $q->whereNotIn('id',
                                    Assessment::where('student_id', $studentId)
                                        ->where('measurement_type_id', '!=', $get('measurement_type_id'))
                                        ->pluck('measurement_type_id')
                                )
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
}
