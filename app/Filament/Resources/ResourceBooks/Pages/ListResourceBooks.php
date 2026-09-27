<?php

namespace App\Filament\Resources\ResourceBooks\Pages;

use App\Filament\Resources\ResourceBooks\ResourceBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResourceBooks extends ListRecords
{
    protected static string $resource = ResourceBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
