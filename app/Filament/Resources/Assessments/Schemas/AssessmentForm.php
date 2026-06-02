<?php

namespace App\Filament\Resources\Assessments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                    ->required(),

                Select::make('measurement_type_id')
                    ->label('Tipo de Medição')
                    ->relationship('measurementType', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->step(0.01)
                    ->required(),

                DatePicker::make('assessed_at')
                    ->label('Data da Avaliação')
                    ->displayFormat('d/m/Y')
                    ->required(),

                Select::make('user_id')
                    ->label('Avaliador')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->nullable()
                    ->columnSpanFull(),

                Textarea::make('notes')
                    ->label('Observações')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
