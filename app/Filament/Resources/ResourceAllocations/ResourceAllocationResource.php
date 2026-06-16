<?php

namespace App\Filament\Resources\ResourceAllocations;

use App\Filament\Resources\ResourceAllocations\Pages\CreateResourceAllocation;
use App\Filament\Resources\ResourceAllocations\Pages\EditResourceAllocation;
use App\Filament\Resources\ResourceAllocations\Pages\ListResourceAllocations;
use App\Filament\Resources\ResourceAllocations\Schemas\ResourceAllocationForm;
use App\Filament\Resources\ResourceAllocations\Tables\ResourceAllocationsTable;
use App\Models\ResourceAllocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResourceAllocationResource extends Resource
{
    protected static ?string $model = ResourceAllocation::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static string|\UnitEnum|null $navigationGroup = 'Step 3 · Timeline';
    protected static ?string $navigationLabel = 'Resource Allocation';
    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return ResourceAllocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResourceAllocationsTable::configure($table);
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
            'index' => ListResourceAllocations::route('/'),
            'create' => CreateResourceAllocation::route('/create'),
            'edit' => EditResourceAllocation::route('/{record}/edit'),
        ];
    }
}

