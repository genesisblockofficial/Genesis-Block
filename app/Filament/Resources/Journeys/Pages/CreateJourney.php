<?php

namespace App\Filament\Resources\Journeys\Pages;

use App\Filament\Resources\Journeys\JourneyResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateJourney extends CreateRecord
{
    protected static string $resource = JourneyResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Journey Created Successfully')
            ->body('The journey has been created successfully.')
            ->success();
    }
}
