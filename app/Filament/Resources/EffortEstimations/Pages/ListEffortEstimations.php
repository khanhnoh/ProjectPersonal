<?php

namespace App\Filament\Resources\EffortEstimations\Pages;

use App\Filament\Resources\EffortEstimations\EffortEstimationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEffortEstimations extends ListRecords
{
    protected static string $resource = EffortEstimationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
