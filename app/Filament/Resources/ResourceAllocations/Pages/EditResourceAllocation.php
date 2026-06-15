<?php

namespace App\Filament\Resources\ResourceAllocations\Pages;

use App\Filament\Resources\ResourceAllocations\ResourceAllocationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResourceAllocation extends EditRecord
{
    protected static string $resource = ResourceAllocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
