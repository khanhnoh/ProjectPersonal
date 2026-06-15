<?php

namespace App\Filament\Resources\BANTAssessments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BANTAssessmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lead.id')
                    ->searchable(),
                TextColumn::make('budget_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('authority_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('need_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('timeline_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('overall_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('recommendation')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
