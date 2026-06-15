<?php

namespace App\Filament\Resources\PitchingChecklists\Pages;

use App\Filament\Resources\PitchingChecklists\PitchingChecklistResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPitchingChecklist extends EditRecord
{
    protected static string $resource = PitchingChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
