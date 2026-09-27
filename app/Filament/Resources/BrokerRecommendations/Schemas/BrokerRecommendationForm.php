<?php

namespace App\Filament\Resources\BrokerRecommendations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrokerRecommendationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('market')
                    ->options([
                        'stock' => 'Stock market',
                        'forex' => 'Forex',
                    ])
                    ->required(),
                TextInput::make('website_url')
                    ->label('Recommendation URL')
                    ->url()
                    ->required(),
                FileUpload::make('logo')
                    ->label('Broker logo')
                    ->image()
                    ->disk('public')
                    ->directory('broker-recommendations')
                    ->imageEditor()
                    ->maxSize(2048),
                Textarea::make('description')
                    ->rows(3)
                    ->maxLength(1000),
                TextInput::make('sort_order')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Show on Resources page')
                    ->default(true)
                    ->required(),
            ]);
    }
}
