<?php

namespace App\Filament\Resources\CostEstimations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CostEstimationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope_id')
                    ->relationship('scope', 'id')
                    ->required(),
                TextInput::make('hourly_rate')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('labor_cost')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('material_cost')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('markup_percentage')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('final_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                Select::make('currency')
                    ->options(['VND' => 'V n d', 'USD' => 'U s d'])
                    ->default('VND')
                    ->required(),
            ]);
    }
}
