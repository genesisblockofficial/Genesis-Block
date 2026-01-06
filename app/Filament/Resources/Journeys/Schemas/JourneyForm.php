<?php

namespace App\Filament\Resources\Journeys\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JourneyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('years')
                    ->numeric(),
                TextInput::make('title'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
