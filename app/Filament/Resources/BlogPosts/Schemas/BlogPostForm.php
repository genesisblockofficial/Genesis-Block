<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->alphaDash()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('category')
                    ->maxLength(100),
                TextInput::make('author')
                    ->maxLength(150),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Article content (Markdown)')
                    ->rows(18)
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image()
                    ->disk('public')
                    ->directory('blog-covers')
                    ->imageEditor()
                    ->maxSize(4096),
                DateTimePicker::make('published_at')
                    ->default(now()),
                TextInput::make('sort_order')
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(false),
            ]);
    }
}
