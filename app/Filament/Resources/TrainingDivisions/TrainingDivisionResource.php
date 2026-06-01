<?php

namespace App\Filament\Resources\TrainingDivisions;

use App\Filament\Resources\TrainingDivisions\Pages\CreateTrainingDivision;
use App\Filament\Resources\TrainingDivisions\Pages\EditTrainingDivision;
use App\Filament\Resources\TrainingDivisions\Pages\ListTrainingDivisions;
use App\Filament\Resources\TrainingDivisions\Schemas\TrainingDivisionForm;
use App\Filament\Resources\TrainingDivisions\Tables\TrainingDivisionsTable;
use App\Models\TrainingDivision;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class TrainingDivisionResource extends Resource
{
    protected static ?string $model = TrainingDivision::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Divisão de Treino';

    protected static ?string $pluralModelLabel = 'Divisões de Treino';

    protected static ?string $navigationLabel = 'Divisões de Treino';

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    public static function form(Schema $schema): Schema
    {
        return TrainingDivisionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrainingDivisionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrainingDivisions::route('/'),
            'create' => CreateTrainingDivision::route('/create'),
            'edit' => EditTrainingDivision::route('/{record}/edit'),
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
