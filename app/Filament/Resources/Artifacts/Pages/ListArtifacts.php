<?php

namespace App\Filament\Resources\Artifacts\Pages;

use App\Filament\Resources\Artifacts\ArtifactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArtifacts extends ListRecords
{
    protected static string $resource = ArtifactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
