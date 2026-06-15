<?php

namespace App\Filament\Resources\PitchingChecklists\Pages;

use App\Filament\Resources\PitchingChecklists\PitchingChecklistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPitchingChecklists extends ListRecords
{
    protected static string $resource = PitchingChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
