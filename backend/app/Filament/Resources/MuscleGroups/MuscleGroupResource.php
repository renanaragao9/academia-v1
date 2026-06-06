<?php

namespace App\Filament\Resources\MuscleGroups;

use App\Filament\Resources\MuscleGroups\Pages\CreateMuscleGroup;
use App\Filament\Resources\MuscleGroups\Pages\EditMuscleGroup;
use App\Filament\Resources\MuscleGroups\Pages\ListMuscleGroups;
use App\Filament\Resources\MuscleGroups\Schemas\MuscleGroupForm;
use App\Filament\Resources\MuscleGroups\Tables\MuscleGroupsTable;
use App\Models\MuscleGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MuscleGroupResource extends Resource
{
    protected static ?string $model = MuscleGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;

    protected static ?string $modelLabel = 'Grupo Muscular';

    protected static ?string $pluralModelLabel = 'Grupos Musculares';

    protected static ?string $navigationLabel = 'Grupos Musculares';

    protected static ?int $navigationSort = 2;

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    public static function form(Schema $schema): Schema
    {
        return MuscleGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MuscleGroupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMuscleGroups::route('/'),
            'create' => CreateMuscleGroup::route('/create'),
            'edit' => EditMuscleGroup::route('/{record}/edit'),
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
