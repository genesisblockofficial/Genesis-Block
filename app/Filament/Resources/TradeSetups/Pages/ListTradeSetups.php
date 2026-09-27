<?php

namespace App\Filament\Resources\TradeSetups\Pages;

use App\Filament\Resources\TradeSetups\TradeSetupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTradeSetups extends ListRecords
{
    protected static string $resource = TradeSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
