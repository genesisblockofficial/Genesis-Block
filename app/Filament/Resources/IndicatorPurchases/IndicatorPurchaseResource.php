<?php

namespace App\Filament\Resources\IndicatorPurchases;

use App\Filament\Resources\IndicatorPurchases\Pages\ListIndicatorPurchases;
use App\Filament\Resources\IndicatorPurchases\Tables\IndicatorPurchasesTable;
use App\Models\IndicatorPurchase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IndicatorPurchaseResource extends Resource
{
    protected static ?string $model = IndicatorPurchase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CreditCard;

    protected static ?string $navigationLabel = 'Indicator Purchases';

    protected static ?string $recordTitleAttribute = 'email';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    public static function table(Table $table): Table
    {
        return IndicatorPurchasesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIndicatorPurchases::route('/'),
        ];
    }
}
