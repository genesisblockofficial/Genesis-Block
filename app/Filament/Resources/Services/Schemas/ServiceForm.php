<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Course Title'),
                Toggle::make('is_active')
                    ->label('Publish Course')
                    ->inline(false)
                    ->required(),
                FileUpload::make('image')
                    ->helperText('Recommended course cover image, max 1MB')
                    ->label('Course Cover')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Course Overview')
                    ->columnSpanFull(),
            ]);
    }
}
