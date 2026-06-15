<?php

namespace App\Filament\Resources\Artifacts\Pages;

use App\Filament\Resources\Artifacts\ArtifactResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArtifact extends EditRecord
{
    protected static string $resource = ArtifactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
