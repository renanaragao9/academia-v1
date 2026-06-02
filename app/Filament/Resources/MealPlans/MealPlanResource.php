<?php

namespace App\Filament\Resources\MealPlans;

use App\Filament\Resources\MealPlans\Pages\CreateMealPlan;
use App\Filament\Resources\MealPlans\Pages\EditMealPlan;
use App\Filament\Resources\MealPlans\Pages\ListMealPlans;
use App\Filament\Resources\MealPlans\Pages\ViewMealPlan;
use App\Filament\Resources\MealPlans\Schemas\MealPlanForm;
use App\Filament\Resources\MealPlans\Schemas\MealPlanInfolist;
use App\Filament\Resources\MealPlans\Tables\MealPlansTable;
use App\Models\MealPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MealPlanResource extends Resource
{
    protected static ?string $model = MealPlan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $modelLabel = 'Plano Alimentar';

    protected static ?string $pluralModelLabel = 'Planos Alimentares';

    protected static ?string $navigationLabel = 'Planos Alimentares';

    protected static string|UnitEnum|null $navigationGroup = 'Nutrição';

    public static function form(Schema $schema): Schema
    {
        return MealPlanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MealPlanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MealPlansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMealPlans::route('/'),
            'create' => CreateMealPlan::route('/create'),
            'view' => ViewMealPlan::route('/{record}'),
            'edit' => EditMealPlan::route('/{record}/edit'),
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
