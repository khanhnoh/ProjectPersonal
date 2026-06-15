<?php

namespace App\Filament\Resources\EffortEstimations;

use App\Filament\Resources\EffortEstimations\Pages\CreateEffortEstimation;
use App\Filament\Resources\EffortEstimations\Pages\EditEffortEstimation;
use App\Filament\Resources\EffortEstimations\Pages\ListEffortEstimations;
use App\Filament\Resources\EffortEstimations\Schemas\EffortEstimationForm;
use App\Filament\Resources\EffortEstimations\Tables\EffortEstimationsTable;
use App\Models\EffortEstimation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EffortEstimationResource extends Resource
{
    protected static ?string $model = EffortEstimation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return EffortEstimationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EffortEstimationsTable::configure($table);
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
            'index' => ListEffortEstimations::route('/'),
            'create' => CreateEffortEstimation::route('/create'),
            'edit' => EditEffortEstimation::route('/{record}/edit'),
        ];
    }
}
