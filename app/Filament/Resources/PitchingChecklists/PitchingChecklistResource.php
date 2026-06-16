<?php

namespace App\Filament\Resources\PitchingChecklists;

use App\Filament\Resources\PitchingChecklists\Pages\CreatePitchingChecklist;
use App\Filament\Resources\PitchingChecklists\Pages\EditPitchingChecklist;
use App\Filament\Resources\PitchingChecklists\Pages\ListPitchingChecklists;
use App\Filament\Resources\PitchingChecklists\Schemas\PitchingChecklistForm;
use App\Filament\Resources\PitchingChecklists\Tables\PitchingChecklistsTable;
use App\Models\PitchingChecklist;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PitchingChecklistResource extends Resource
{
    protected static ?string $model = PitchingChecklist::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static string|\UnitEnum|null $navigationGroup = 'Step 4 · Pitching';
    protected static ?string $navigationLabel = 'Pitching Checklist';
    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema
    {
        return PitchingChecklistForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PitchingChecklistsTable::configure($table);
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
            'index' => ListPitchingChecklists::route('/'),
            'create' => CreatePitchingChecklist::route('/create'),
            'edit' => EditPitchingChecklist::route('/{record}/edit'),
        ];
    }
}

