<?php

namespace App\Filament\Resources\PitchingChecklists\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PitchingChecklistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope_id')
                    ->relationship('scope', 'id')
                    ->required(),
                Textarea::make('checklist_item')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_completed')
                    ->required(),
                TextInput::make('assigned_to'),
                DatePicker::make('due_date'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
