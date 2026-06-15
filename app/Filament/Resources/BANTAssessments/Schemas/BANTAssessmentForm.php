<?php

namespace App\Filament\Resources\BANTAssessments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BANTAssessmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lead_id')
                    ->relationship('lead', 'id')
                    ->required(),
                TextInput::make('budget_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('authority_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('need_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('timeline_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('budget_notes')
                    ->columnSpanFull(),
                Textarea::make('authority_notes')
                    ->columnSpanFull(),
                Textarea::make('need_notes')
                    ->columnSpanFull(),
                Textarea::make('timeline_notes')
                    ->columnSpanFull(),
                TextInput::make('overall_score')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('recommendation')
                    ->options([
            'qualified' => 'Qualified',
            'needs_follow_up' => 'Needs follow up',
            'not_qualified' => 'Not qualified',
        ])
                    ->default('needs_follow_up')
                    ->required(),
            ]);
    }
}
