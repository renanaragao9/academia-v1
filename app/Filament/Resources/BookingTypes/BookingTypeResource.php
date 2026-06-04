<?php

namespace App\Filament\Resources\BookingTypes;

use App\Filament\Resources\BookingTypes\Pages\CreateBookingType;
use App\Filament\Resources\BookingTypes\Pages\EditBookingType;
use App\Filament\Resources\BookingTypes\Pages\ListBookingTypes;
use App\Filament\Resources\BookingTypes\Schemas\BookingTypeForm;
use App\Filament\Resources\BookingTypes\Tables\BookingTypesTable;
use App\Models\BookingType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Schema as IlluminateSchema;
use UnitEnum;

class BookingTypeResource extends Resource
{
    protected static ?string $model = BookingType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $modelLabel = 'Tipo de Evento';

    protected static ?string $pluralModelLabel = 'Tipos de Evento';

    protected static ?string $navigationLabel = 'Tipos de Evento';

    protected static ?int $navigationSort = 11;

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    public static function canAccess(): bool
    {
        return IlluminateSchema::hasTable('booking_types') && parent::canAccess();
    }

    public static function form(Schema $schema): Schema
    {
        return BookingTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookingTypes::route('/'),
            'create' => CreateBookingType::route('/create'),
            'edit' => EditBookingType::route('/{record}/edit'),
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
