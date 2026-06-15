<?php

namespace App\Filament\Resources\BANTAssessments\Pages;

use App\Filament\Resources\BANTAssessments\BANTAssessmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBANTAssessment extends EditRecord
{
    protected static string $resource = BANTAssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
