<?php

namespace App\Filament\Pages;

use App\Models\SocialMediaSettings as SocialMediaSettingsModel;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SocialMediaSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Share;

    protected static ?string $navigationLabel = 'Social Media Links';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.social-media-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public function mount(): void
    {
        $settings = SocialMediaSettingsModel::query()->first();
        $this->settingsId = $settings?->id;
        $this->form->fill($settings?->toArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Footer social links')
                    ->description('Only filled links appear as clickable icons in the public footer and WhatsApp support actions.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('youtube_url')->label('YouTube URL')->url()->placeholder('https://youtube.com/@yourchannel'),
                        TextInput::make('telegram_url')->label('Telegram URL')->url()->placeholder('https://t.me/yourchannel'),
                        TextInput::make('whatsapp_url')->label('WhatsApp URL')->url()->placeholder('https://wa.me/919876543210'),
                        TextInput::make('instagram_url')->label('Instagram URL')->url()->placeholder('https://instagram.com/yourprofile'),
                        TextInput::make('facebook_url')->label('Facebook URL')->url()->placeholder('https://facebook.com/yourpage'),
                        TextInput::make('x_url')->label('X / Twitter URL')->url()->placeholder('https://x.com/yourprofile'),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? SocialMediaSettingsModel::query()->findOrFail($this->settingsId)
            : new SocialMediaSettingsModel();

        $settings->fill($data)->save();

        Notification::make()
            ->title('Social media links saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }
}
