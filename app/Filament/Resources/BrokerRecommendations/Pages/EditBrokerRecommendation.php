<?php

namespace App\Filament\Resources\BrokerRecommendations\Pages;

use App\Filament\Resources\BrokerRecommendations\BrokerRecommendationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrokerRecommendation extends EditRecord
{
    protected static string $resource = BrokerRecommendationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
