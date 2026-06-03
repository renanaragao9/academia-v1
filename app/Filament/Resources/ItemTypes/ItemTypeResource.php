<?php

namespace App\Filament\Resources\ItemTypes;

use App\Filament\Resources\ItemTypes\Pages\CreateItemType;
use App\Filament\Resources\ItemTypes\Pages\EditItemType;
use App\Filament\Resources\ItemTypes\Pages\ListItemTypes;
use App\Filament\Resources\ItemTypes\Schemas\ItemTypeForm;
use App\Filament\Resources\ItemTypes\Tables\ItemTypesTable;
use App\Models\ItemType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ItemTypeResource extends Resource
{
    protected static ?string $model = ItemType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $modelLabel = 'Tipo de Item';

    protected static ?string $pluralModelLabel = 'Tipos de Item';

    protected static ?string $navigationLabel = 'Tipos de Item';

    protected static ?int $navigationSort = 7;

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    public static function form(Schema $schema): Schema
    {
        return ItemTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemTypes::route('/'),
            'create' => CreateItemType::route('/create'),
            'edit' => EditItemType::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
