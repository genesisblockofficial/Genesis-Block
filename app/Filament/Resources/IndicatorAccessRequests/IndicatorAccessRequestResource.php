<?php

namespace App\Filament\Resources\IndicatorAccessRequests;

use App\Filament\Resources\IndicatorAccessRequests\Pages\ListIndicatorAccessRequests;
use App\Filament\Resources\IndicatorAccessRequests\Tables\IndicatorAccessRequestsTable;
use App\Models\IndicatorAccessRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IndicatorAccessRequestResource extends Resource
{
    protected static ?string $model = IndicatorAccessRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $navigationLabel = 'Free Access Requests';

    protected static ?string $recordTitleAttribute = 'email';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    public static function table(Table $table): Table
    {
        return IndicatorAccessRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIndicatorAccessRequests::route('/'),
        ];
    }
}
