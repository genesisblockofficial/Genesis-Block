<?php

namespace App\Filament\Resources\ResourceBooks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResourceBookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('author')
                    ->maxLength(255),
                TextInput::make('amazon_url')
                    ->label('Amazon purchase URL')
                    ->url()
                    ->required(),
                FileUpload::make('cover_image')
                    ->label('Book cover')
                    ->image()
                    ->disk('public')
                    ->directory('resource-books')
                    ->imageEditor()
                    ->maxSize(2048),
                Toggle::make('is_beginner')
                    ->label('Recommended for beginners'),
                Toggle::make('for_experienced_traders')
                    ->label('Recommended for experienced traders'),
                Toggle::make('is_self_help')
                    ->label('Self-development'),
                TextInput::make('rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5)
                    ->required(),
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
