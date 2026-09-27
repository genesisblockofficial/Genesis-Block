<?php

namespace App\Filament\Resources\BrokerRecommendations;

use App\Filament\Resources\BrokerRecommendations\Pages\CreateBrokerRecommendation;
use App\Filament\Resources\BrokerRecommendations\Pages\EditBrokerRecommendation;
use App\Filament\Resources\BrokerRecommendations\Pages\ListBrokerRecommendations;
use App\Filament\Resources\BrokerRecommendations\Schemas\BrokerRecommendationForm;
use App\Filament\Resources\BrokerRecommendations\Tables\BrokerRecommendationsTable;
use App\Models\BrokerRecommendation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BrokerRecommendationResource extends Resource
{
    protected static ?string $model = BrokerRecommendation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Star;

    protected static ?string $navigationLabel = 'Broker Recommendations';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    public static function form(Schema $schema): Schema
    {
        return BrokerRecommendationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrokerRecommendationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrokerRecommendations::route('/'),
            'create' => CreateBrokerRecommendation::route('/create'),
            'edit' => EditBrokerRecommendation::route('/{record}/edit'),
        ];
    }
}
