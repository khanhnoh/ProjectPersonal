<?php

namespace App\Filament\Resources\CostEstimations\Pages;

use App\Filament\Resources\CostEstimations\CostEstimationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCostEstimation extends EditRecord
{
    protected static string $resource = CostEstimationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
