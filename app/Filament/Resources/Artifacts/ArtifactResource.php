<?php

namespace App\Filament\Resources\Artifacts;

use App\Filament\Resources\Artifacts\Pages\CreateArtifact;
use App\Filament\Resources\Artifacts\Pages\EditArtifact;
use App\Filament\Resources\Artifacts\Pages\ListArtifacts;
use App\Filament\Resources\Artifacts\Schemas\ArtifactForm;
use App\Filament\Resources\Artifacts\Tables\ArtifactsTable;
use App\Models\Artifact;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArtifactResource extends Resource
{
    protected static ?string $model = Artifact::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-clip';
    protected static string|\UnitEnum|null $navigationGroup = 'Step 4 · Pitching';
    protected static ?string $navigationLabel = 'Artifacts';
    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return ArtifactForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArtifactsTable::configure($table);
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
            'index' => ListArtifacts::route('/'),
            'create' => CreateArtifact::route('/create'),
            'edit' => EditArtifact::route('/{record}/edit'),
        ];
    }
}

