<?php

namespace App\Filament\Resources\TradeSetups\Pages;

use App\Filament\Resources\TradeSetups\TradeSetupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTradeSetup extends EditRecord
{
    protected static string $resource = TradeSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
