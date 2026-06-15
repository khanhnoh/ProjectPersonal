<?php

namespace App\Filament\Resources\EffortEstimations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EffortEstimationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope_id')
                    ->relationship('scope', 'id')
                    ->required(),
                TextInput::make('task_name')
                    ->required(),
                TextInput::make('estimated_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('assigned_to')
                    ->required()
                    ->default('TBD'),
                Select::make('status')
                    ->options(['draft' => 'Draft', 'approved' => 'Approved', 'in_progress' => 'In progress'])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
