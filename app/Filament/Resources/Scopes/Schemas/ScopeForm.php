<?php

namespace App\Filament\Resources\Scopes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ScopeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lead_id')
                    ->relationship('lead', 'id')
                    ->required(),
                TextInput::make('scope_title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('estimated_duration')
                    ->numeric(),
                Select::make('status')
                    ->options([
            'draft' => 'Draft',
            'approved' => 'Approved',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
        ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
