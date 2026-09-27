<?php

namespace App\Filament\Resources\BrokerRecommendations\Pages;

use App\Filament\Resources\BrokerRecommendations\BrokerRecommendationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBrokerRecommendations extends ListRecords
{
    protected static string $resource = BrokerRecommendationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
