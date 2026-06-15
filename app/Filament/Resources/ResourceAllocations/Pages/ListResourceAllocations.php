<?php

namespace App\Filament\Resources\ResourceAllocations\Pages;

use App\Filament\Resources\ResourceAllocations\ResourceAllocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResourceAllocations extends ListRecords
{
    protected static string $resource = ResourceAllocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
