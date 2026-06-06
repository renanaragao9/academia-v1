<?php

namespace App\Filament\Resources\Configurations;

use App\Filament\Resources\Configurations\Pages\EditConfiguration;
use App\Filament\Resources\Configurations\Pages\ListConfigurations;
use App\Filament\Resources\Configurations\Pages\ViewConfiguration;
use App\Filament\Resources\Configurations\Schemas\ConfigurationForm;
use App\Filament\Resources\Configurations\Schemas\ConfigurationInfolist;
use App\Models\Configuration;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ConfigurationResource extends Resource
{
    protected static ?string $model = Configuration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $modelLabel = 'Configuração';

    protected static ?string $pluralModelLabel = 'Configurações';

    protected static ?string $navigationLabel = 'Configurações';

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ConfigurationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConfigurationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConfigurations::route('/'),
            'view' => ViewConfiguration::route('/{record}'),
            'edit' => EditConfiguration::route('/{record}/edit'),
        ];
    }
}
