<?php

namespace App\Filament\Resources\ResourceBooks\Pages;

use App\Filament\Resources\ResourceBooks\ResourceBookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResourceBook extends EditRecord
{
    protected static string $resource = ResourceBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
