<?php

namespace App\Filament\Resources\Indicators\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IndicatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->alphaDash()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('summary')
                    ->rows(2)
                    ->maxLength(500),
                Textarea::make('description')
                    ->rows(5)
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image()
                    ->disk('public')
                    ->directory('indicators')
                    ->imageEditor()
                    ->maxSize(4096),
                Toggle::make('is_paid')
                    ->label('Paid indicator')
                    ->live(),
                TextInput::make('price_cents')
                    ->label('Price in USD cents (e.g. 2500 = $25.00)')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->helperText('For paid indicators, Stripe Checkout requires at least 50 cents ($0.50 USD). Free indicators can remain at 0.')
                    ->required(),
                TextInput::make('trading_view_url')
                    ->label('Private TradingView access URL')
                    ->url()
                    ->helperText('Never shown publicly. Emailed only after free-request approval or paid-order approval.'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Visible on public page')
                    ->default(true)
                    ->required(),
            ]);
    }
}
