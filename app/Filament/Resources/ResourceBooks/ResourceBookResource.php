<?php

namespace App\Filament\Resources\ResourceBooks;

use App\Filament\Resources\ResourceBooks\Pages\CreateResourceBook;
use App\Filament\Resources\ResourceBooks\Pages\EditResourceBook;
use App\Filament\Resources\ResourceBooks\Pages\ListResourceBooks;
use App\Filament\Resources\ResourceBooks\Schemas\ResourceBookForm;
use App\Filament\Resources\ResourceBooks\Tables\ResourceBooksTable;
use App\Models\ResourceBook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ResourceBookResource extends Resource
{
    protected static ?string $model = ResourceBook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;

    protected static ?string $navigationLabel = 'Recommended Books';

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    public static function form(Schema $schema): Schema
    {
        return ResourceBookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResourceBooksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResourceBooks::route('/'),
            'create' => CreateResourceBook::route('/create'),
            'edit' => EditResourceBook::route('/{record}/edit'),
        ];
    }
}
