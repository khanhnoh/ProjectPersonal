<?php

namespace App\Filament\Resources\ResourceAllocations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ResourceAllocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('timeline_id')
                    ->relationship('timeline', 'id')
                    ->required(),
                TextInput::make('resource_name')
                    ->required(),
                TextInput::make('role'),
                TextInput::make('allocation_percentage')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
