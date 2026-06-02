<?php

namespace App\Filament\Resources\MealPlans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class MealPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Dados do Plano')
                    ->columns(2)
                    ->schema([
                        Select::make('student_id')
                            ->label('Aluno')
                            ->relationship(
                                name: 'student',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query): Builder => $query
                                    ->where('is_active', true)
                                    ->orderBy('name'),
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome do Plano')
                            ->placeholder('Ex.: Plano Junho/2026')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('start_date')
                            ->label('Início')
                            ->displayFormat('d/m/Y')
                            ->nullable(),

                        DatePicker::make('end_date')
                            ->label('Fim')
                            ->displayFormat('d/m/Y')
                            ->nullable(),

                        Toggle::make('is_active')
                            ->label('Plano ativo')
                            ->default(true)
                            ->columnSpanFull(),
                    ]),

                Section::make('Refeições e Alimentos')
                    ->description('Adicione as refeições (Café da manhã, Almoço...) e os alimentos de cada uma.')
                    ->schema([
                        Repeater::make('meals')
                            ->label('Refeições')
                            ->relationship()
                            ->orderColumn('order')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->cloneable()
                            ->defaultItems(0)
                            ->addActionLabel('Adicionar refeição')
                            ->schema([
                                Select::make('meal_type_id')
                                    ->label('Tipo de Refeição')
                                    ->relationship(
                                        name: 'mealType',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: fn (Builder $query): Builder => $query
                                            ->where('is_active', true)
                                            ->orderBy('name'),
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required(),

                                Repeater::make('foods')
                                    ->label('Alimentos')
                                    ->relationship()
                                    ->orderColumn('order')
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->cloneable()
                                    ->defaultItems(0)
                                    ->addActionLabel('Adicionar alimento')
                                    ->columns(4)
                                    ->schema([
                                        Select::make('food_id')
                                            ->label('Alimento')
                                            ->relationship(
                                                name: 'food',
                                                titleAttribute: 'name',
                                                modifyQueryUsing: fn (Builder $query): Builder => $query
                                                    ->where('is_active', true)
                                                    ->orderBy('name'),
                                            )
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->columnSpan(2),

                                        TextInput::make('quantity')
                                            ->label('Quantidade')
                                            ->numeric()
                                            ->step(0.01)
                                            ->minValue(0)
                                            ->nullable(),

                                        TextInput::make('unit')
                                            ->label('Unidade')
                                            ->placeholder('g, ml, colher...')
                                            ->nullable(),

                                        Textarea::make('observation')
                                            ->label('Observações')
                                            ->rows(2)
                                            ->columnSpanFull()
                                            ->nullable(),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
