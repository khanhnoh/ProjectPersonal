<?php

namespace App\Filament\Resources\Artifacts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArtifactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope_id')
                    ->relationship('scope', 'id')
                    ->required(),
                TextInput::make('artifact_name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('file_path'),
                Select::make('file_type')
                    ->options([
            'proposal' => 'Proposal',
            'erd' => 'Erd',
            'wireframe' => 'Wireframe',
            'specification' => 'Specification',
            'other' => 'Other',
        ])
                    ->default('other')
                    ->required(),
                TextInput::make('uploaded_by'),
                DateTimePicker::make('upload_date'),
            ]);
    }
}
