<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                Select::make('item_type_id')
                    ->label('Tipo de Item')
                    ->relationship('itemType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('total_price')
                    ->label('Preço Total')
                    ->numeric()
                    ->step(0.01)
                    ->prefix('R$')
                    ->required(),

                TextInput::make('promotion_price')
                    ->label('Preço de Promoção')
                    ->numeric()
                    ->step(0.01)
                    ->prefix('R$')
                    ->nullable(),

                Textarea::make('description')
                    ->label('Descrição')
                    ->rows(3)
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
