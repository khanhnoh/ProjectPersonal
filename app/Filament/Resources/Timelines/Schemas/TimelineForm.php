<?php

namespace App\Filament\Resources\Timelines\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TimelineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope_id')
                    ->relationship('scope', 'id')
                    ->required(),
                TextInput::make('phase_name')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Select::make('status')
                    ->options([
            'not_started' => 'Not started',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
            'delayed' => 'Delayed',
        ])
                    ->default('not_started')
                    ->required(),
            ]);
    }
}
