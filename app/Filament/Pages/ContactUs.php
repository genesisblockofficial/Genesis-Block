<?php

namespace App\Filament\Pages;

use App\Models\ContactUs as ContactUsModel;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ContactUs extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $recordTitleAttribute = 'Contact Us';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.contact-us';

    public ?array $data = [];

    protected ?ContactUsModel $record = null;

    public static function getNavigationLabel(): string
    {
        return 'Contact Us';
    }

    /**
     * Load or create record
     */
    public function mount(): void
    {
        $this->record = ContactUsModel::firstOrCreate([]);

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
                Section::make('Customer Support')
                    ->description('Customer support contact information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('customer_support_title')
                                    ->label('Title')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('customer_support_email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('customer_support_phone')
                                    ->label('Phone')
                                    ->tel()
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('customer_support_hours')
                                    ->label('Availability Hours')
                                    ->maxLength(255),
                            ])->columns(2),

                        Forms\Components\Textarea::make('customer_support_description')
                            ->label('Description')
                            ->rows(3),
                    ])->columns(1),

                Section::make('Sales & Partnerships')
                    ->description('Sales and partnership contact information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('sales_partnerships_title')
                                    ->label('Title')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('sales_partnerships_email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('sales_partnerships_phone')
                                    ->label('Phone')
                                    ->tel()
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('sales_partnerships_hours')
                                    ->label('Availability Hours')
                                    ->maxLength(255),
                            ])->columns(2),

                        Forms\Components\Textarea::make('sales_partnerships_description')
                            ->label('Description')
                            ->rows(3),
                    ])->columns(1),

                Section::make('Education & Training')
                    ->description('Education and training contact information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('education_training_title')
                                    ->label('Title')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('education_training_email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('education_training_phone')
                                    ->label('Phone')
                                    ->tel()
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('education_training_hours')
                                    ->label('Training Hours')
                                    ->maxLength(255),

                            ])->columns(2),

                        Forms\Components\Textarea::make('education_training_description')
                            ->label('Description')
                            ->rows(3),

                    ])->columns(1),

                Section::make('Company Information')
                    ->description('General company contact information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Company Name')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('website')
                                    ->label('Website')
                                    ->url()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone')
                                    ->tel()
                                    ->maxLength(50),
                            ])->columns(2),

                        Forms\Components\Textarea::make('address')
                            ->label('Address')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Save data
     */
    public function save(): void
    {
        $this->record = $this->record ?? \App\Models\ContactUs::firstOrCreate([]);

        $this->record->update($this->form->getState());

        Notification::make()
            ->title('Contact Us updated')
            ->body('Contact Us updated successfully.')
            ->success()
            ->send();
    }
}
