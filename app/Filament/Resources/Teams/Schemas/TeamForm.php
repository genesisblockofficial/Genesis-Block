<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('position')
                                    ->label('Position/Role')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2),

                        Textarea::make('description')
                            ->label('Bio/Description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Brief description about the team member...')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Settings')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Profile Image')
                            ->image()
                            ->directory('team-members')
                            ->avatar()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->maxSize(2048)
                            ->helperText('Recommended: 400x400 px, max 2MB')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Active Member')
                            ->default(true)
                            ->helperText('Show this member on the team page'),

                        Toggle::make('is_featured')
                            ->label('Featured Member')
                            ->default(false)
                            ->helperText('Highlight this member in featured sections'),
                    ])
                    ->columnSpan(['lg' => 1]),

                Section::make('Social Media Links')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('linkedin')
                                    ->label('LinkedIn')
                                    ->prefixIcon('heroicon-m-link')
                                    ->url()
                                    ->placeholder('https://linkedin.com/in/username')
                                    ->nullable()
                                    ->columnSpanFull(),

                                TextInput::make('twitter')
                                    ->label('Twitter')
                                    ->prefixIcon('heroicon-m-link')
                                    ->url()
                                    ->placeholder('https://twitter.com/username')
                                    ->nullable()
                                    ->columnSpanFull(),

                                TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->prefixIcon('heroicon-m-link')
                                    ->url()
                                    ->placeholder('https://facebook.com/username')
                                    ->nullable()
                                    ->columnSpanFull(),

                                TextInput::make('instagram')
                                    ->label('Instagram')
                                    ->prefixIcon('heroicon-m-link')
                                    ->url()
                                    ->placeholder('https://instagram.com/username')
                                    ->nullable()
                                    ->columnSpanFull(),

                                TextInput::make('youtube')
                                    ->label('YouTube')
                                    ->prefixIcon('heroicon-m-link')
                                    ->url()
                                    ->placeholder('https://youtube.com/username')
                                    ->nullable()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
