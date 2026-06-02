<?php

namespace App\Filament\Resources\MonthlyFees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class MonthlyFeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Dados da Mensalidade')
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
                            ->required()
                            ->columnSpanFull(),

                        Select::make('plan_type_id')
                            ->label('Plano')
                            ->relationship(
                                name: 'planType',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query): Builder => $query
                                    ->where('is_active', true)
                                    ->orderBy('name'),
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_type_id')
                            ->label('Forma de Pagamento')
                            ->relationship(
                                name: 'paymentType',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query): Builder => $query
                                    ->where('is_active', true)
                                    ->orderBy('name'),
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        DatePicker::make('start_date')
                            ->label('Início da Vigência')
                            ->displayFormat('d/m/Y')
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('Fim da Vigência')
                            ->displayFormat('d/m/Y')
                            ->required(),

                        DatePicker::make('date_payment')
                            ->label('Data do Pagamento')
                            ->displayFormat('d/m/Y')
                            ->nullable(),

                        TextInput::make('full_payment')
                            ->label('Valor Cheio (R$)')
                            ->numeric()
                            ->step(0.01)
                            ->prefix('R$')
                            ->required(),

                        TextInput::make('discount_payment')
                            ->label('Desconto (R$)')
                            ->numeric()
                            ->step(0.01)
                            ->prefix('R$')
                            ->default(0),
                    ]),
            ]);
    }
}
