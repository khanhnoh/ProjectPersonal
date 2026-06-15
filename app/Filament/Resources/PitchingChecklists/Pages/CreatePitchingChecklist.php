<?php

namespace App\Filament\Resources\PitchingChecklists\Pages;

use App\Filament\Resources\PitchingChecklists\PitchingChecklistResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePitchingChecklist extends CreateRecord
{
    protected static string $resource = PitchingChecklistResource::class;
}
