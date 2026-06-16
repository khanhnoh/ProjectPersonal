<?php

namespace App\Filament\Resources\CostEstimations;

use App\Filament\Resources\CostEstimations\Pages\CreateCostEstimation;
use App\Filament\Resources\CostEstimations\Pages\EditCostEstimation;
use App\Filament\Resources\CostEstimations\Pages\ListCostEstimations;
use App\Filament\Resources\CostEstimations\Schemas\CostEstimationForm;
use App\Filament\Resources\CostEstimations\Tables\CostEstimationsTable;
use App\Models\CostEstimation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CostEstimationResource extends Resource
{
    protected static ?string $model = CostEstimation::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static string|\UnitEnum|null $navigationGroup = 'Step 2 · Scope & Estimation';
    protected static ?string $navigationLabel = 'Cost Estimation';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return CostEstimationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CostEstimationsTable::configure($table);
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
            'index' => ListCostEstimations::route('/'),
            'create' => CreateCostEstimation::route('/create'),
            'edit' => EditCostEstimation::route('/{record}/edit'),
        ];
    }
}

