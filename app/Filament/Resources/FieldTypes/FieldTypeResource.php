<?php

namespace App\Filament\Resources\FieldTypes;

use App\Filament\Resources\FieldTypes\Pages\CreateFieldType;
use App\Filament\Resources\FieldTypes\Pages\EditFieldType;
use App\Filament\Resources\FieldTypes\Pages\ListFieldTypes;
use App\Filament\Resources\FieldTypes\Schemas\FieldTypeForm;
use App\Filament\Resources\FieldTypes\Tables\FieldTypesTable;
use App\Models\FieldType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Schema as IlluminateSchema;
use UnitEnum;

class FieldTypeResource extends Resource
{
    protected static ?string $model = FieldType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquare3Stack3d;

    protected static ?string $modelLabel = 'Tipo de Campo';

    protected static ?string $pluralModelLabel = 'Tipos de Campo';

    protected static ?string $navigationLabel = 'Tipos de Campo';

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    public static function canAccess(): bool
    {
        return IlluminateSchema::hasTable('field_types') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return FieldTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FieldTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFieldTypes::route('/'),
            'create' => CreateFieldType::route('/create'),
            'edit' => EditFieldType::route('/{record}/edit'),
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
