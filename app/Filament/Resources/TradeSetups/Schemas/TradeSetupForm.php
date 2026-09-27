<?php

namespace App\Filament\Resources\TradeSetups\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TradeSetupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('indicator_id')
                    ->label('Related indicator')
                    ->relationship('indicator', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('symbol')
                    ->label('Symbol / instrument')
                    ->required()
                    ->maxLength(64),
                TextInput::make('market')
                    ->placeholder('Stocks, Forex, Crypto...')
                    ->maxLength(64),
                Select::make('direction')
                    ->options([
                        'long' => 'Long',
                        'short' => 'Short',
                        'watch' => 'Watch only',
                    ])
                    ->required(),
                TextInput::make('entry_zone')
                    ->label('Entry zone')
                    ->maxLength(100),
                TextInput::make('stop_loss')
                    ->label('Stop loss')
                    ->maxLength(100),
                TextInput::make('target_zone')
                    ->label('Target zone')
                    ->maxLength(255),
                Textarea::make('analysis')
                    ->rows(5)
                    ->columnSpanFull(),
                FileUpload::make('chart_image')
                    ->image()
                    ->disk('public')
                    ->directory('trade-setups')
                    ->imageEditor()
                    ->maxSize(4096),
                DateTimePicker::make('published_at')
                    ->default(now())
                    ->required(),
                Toggle::make('is_active')
                    ->label('Publish setup')
                    ->default(true)
                    ->required(),
            ]);
    }
}
