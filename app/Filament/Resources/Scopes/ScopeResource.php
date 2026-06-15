<?php

namespace App\Filament\Resources\Scopes;

use App\Filament\Resources\Scopes\Pages\CreateScope;
use App\Filament\Resources\Scopes\Pages\EditScope;
use App\Filament\Resources\Scopes\Pages\ListScopes;
use App\Filament\Resources\Scopes\Schemas\ScopeForm;
use App\Filament\Resources\Scopes\Tables\ScopesTable;
use App\Models\Scope;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ScopeResource extends Resource
{
    protected static ?string $model = Scope::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ScopeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ScopesTable::configure($table);
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
            'index' => ListScopes::route('/'),
            'create' => CreateScope::route('/create'),
            'edit' => EditScope::route('/{record}/edit'),
        ];
    }
}
