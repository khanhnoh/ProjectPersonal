<?php

namespace App\Filament\Resources\EffortEstimations\Pages;

use App\Filament\Resources\EffortEstimations\EffortEstimationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEffortEstimation extends EditRecord
{
    protected static string $resource = EffortEstimationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
