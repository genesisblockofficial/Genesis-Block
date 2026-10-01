<?php

namespace App\Filament\Pages;

use App\Models\AboutUs as AboutUsModel;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class AboutUs extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $recordTitleAttribute = 'About Us';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::InformationCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.about-us';

    public ?array $data = [];

    protected ?AboutUsModel $record = null;

    public static function getNavigationLabel(): string
    {
        return 'About Us';
    }

    /**
     * Load or create record
     */
    public function mount(): void
    {
        $this->record = AboutUsModel::firstOrCreate([]);

        $this->form->fill($this->record->toArray());
    }

    /**
     * Form schema
     */
    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make('Hero Section')
                    ->schema([
                        Forms\Components\TextInput::make('main_heading')
                            ->label('Main Heading')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('sub_heading')
                            ->label('Sub Heading'),
                    ]),

                Section::make('Buttons')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('_is_start_trading')
                            ->label('Show Start Trading Button'),

                        Forms\Components\Toggle::make('_is_view_our_mission')
                            ->label('Show View Our Mission Button'),
                    ]),

                Section::make('Statistics')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('experience_year')
                            ->numeric()
                            ->label('Experience (Years)'),

                        Forms\Components\TextInput::make('traders_count')
                            ->numeric()
                            ->label('Traders Count'),

                        Forms\Components\TextInput::make('countries_count')
                            ->numeric()
                            ->label('Countries Count'),

                        Forms\Components\TextInput::make('traders_volumn')
                            ->numeric()
                            ->label('Trading Volume'),
                    ]),

                Section::make('Mission & Vision')
                    ->schema([
                        Forms\Components\RichEditor::make('mission')
                            ->label('Mission'),

                        Forms\Components\RichEditor::make('vission')
                            ->label('Vision'),
                    ]),

                Section::make('Core Values')
                    ->schema([
                        $this->coreValue('1'),
                        $this->coreValue('2'),
                        $this->coreValue('3'),
                        $this->coreValue('4'),
                    ]),
            ]);
    }

    /**
     * Save data
     */
    public function save(): void
    {
        $this->record = $this->record ?? \App\Models\AboutUs::firstOrCreate([]);

        $this->record->update($this->form->getState());

        Notification::make()
            ->title('Saved')
            ->body('About Us updated successfully.')
            ->success()
            ->send();
    }

    /**
     * Core value helper
     */
    protected function coreValue(string $index): Fieldset
    {
        return Fieldset::make("Core Value {$index}")
            ->schema([
                TextInput::make("core_value_title_{$index}")
                    ->label('Title'),

                Textarea::make("core_value_description_{$index}")
                    ->label('Description'),
            ]);
    }
}
