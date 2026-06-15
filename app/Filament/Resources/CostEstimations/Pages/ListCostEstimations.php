<?php

namespace App\Filament\Resources\CostEstimations\Pages;

use App\Filament\Resources\CostEstimations\CostEstimationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCostEstimations extends ListRecords
{
    protected static string $resource = CostEstimationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
