<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Dom\Text;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Grid::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Gallery Name')
                            ->required()
                            ->maxLength(255),

                        Select::make('parent_id')
                            ->label('Select Parent Gallery')
                            ->options(function () {
                                return \App\Models\Folder::pluck('name', 'id')->toArray();
                            }),
                    ])
                    ->columnSpanFull(),
                TextInput::make('description')
                    ->label('Description')
                    ->maxLength(500)
                    ->columnSpanFull(),

                FileUpload::make('images')
                    ->label('Images')
                    ->image()
                    ->directory('galleries')
                    ->maxSize(5120)
                    ->helperText('You can upload images. for the gallery folders')
                    ->columnSpanFull(),

            ]);
    }
}
