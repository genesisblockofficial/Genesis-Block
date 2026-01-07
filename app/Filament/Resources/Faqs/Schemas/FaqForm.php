<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required()
                    ->maxLength(255)
                    ->label('Question')
                    ->columnSpanFull(),

                RichEditor::make('answer')
                    ->required()
                    ->maxLength(2000)
                    ->label('Answer')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active FAQ')
                    ->default(true)
                    ->inline(false)
                    ->columnSpanFull(),
            ]);
    }
}
