<?php

namespace App\Filament\Resources\TradeSetups;

use App\Filament\Resources\TradeSetups\Pages\CreateTradeSetup;
use App\Filament\Resources\TradeSetups\Pages\EditTradeSetup;
use App\Filament\Resources\TradeSetups\Pages\ListTradeSetups;
use App\Filament\Resources\TradeSetups\Schemas\TradeSetupForm;
use App\Filament\Resources\TradeSetups\Tables\TradeSetupsTable;
use App\Models\TradeSetup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TradeSetupResource extends Resource
{
    protected static ?string $model = TradeSetup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingUp;

    protected static ?string $navigationLabel = 'Trade Setups';

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    public static function form(Schema $schema): Schema
    {
        return TradeSetupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TradeSetupsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTradeSetups::route('/'),
            'create' => CreateTradeSetup::route('/create'),
            'edit' => EditTradeSetup::route('/{record}/edit'),
        ];
    }
}
