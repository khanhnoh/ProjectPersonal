<?php

namespace App\Filament\Resources\BANTAssessments\Pages;

use App\Filament\Resources\BANTAssessments\BANTAssessmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBANTAssessments extends ListRecords
{
    protected static string $resource = BANTAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
