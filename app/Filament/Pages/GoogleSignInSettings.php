<?php

namespace App\Filament\Pages;

use App\Models\GoogleOAuthSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\ValidationException;
use UnitEnum;

class GoogleSignInSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Key;

    protected static ?string $navigationLabel = 'Google Sign-in';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.google-sign-in-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public bool $clientSecretConfigured = false;

    public function mount(): void
    {
        $settings = $this->settingsId
            ? GoogleOAuthSettings::query()->find($this->settingsId)
            : GoogleOAuthSettings::query()->first();

        $this->settingsId = $settings?->id;
        $this->clientSecretConfigured = filled($settings?->client_secret);

        $this->form->fill([
            'client_id' => $settings?->client_id,
            'client_secret' => '',
            'remove_credentials' => false,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Google OAuth credentials')
                    ->description('Enter the OAuth client created in Google Cloud Console. The client secret is encrypted in the database and never shown after saving.')
                    ->schema([
                        TextInput::make('client_id')
                            ->label('Google Client ID')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('1234567890-example.apps.googleusercontent.com'),
                        TextInput::make('client_secret')
                            ->label('Google Client Secret')
                            ->password()
                            ->revealable()
                            ->placeholder($this->clientSecretConfigured ? 'Saved; enter only to change' : 'Enter Google OAuth client secret')
                            ->helperText($this->clientSecretConfigured ? 'A client secret is saved.' : 'The secret is required to enable Google sign-in.'),
                        Toggle::make('remove_credentials')
                            ->label('Remove Google sign-in credentials')
                            ->helperText('Removing credentials disables Google sign-in buttons until credentials are added again.'),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? GoogleOAuthSettings::query()->findOrFail($this->settingsId)
            : new GoogleOAuthSettings;

        if ($data['remove_credentials'] ?? false) {
            if ($settings->exists) {
                $settings->delete();
            }

            Notification::make()
                ->title('Google sign-in credentials removed')
                ->success()
                ->send();

            $this->settingsId = null;
            $this->mount();

            return;
        }

        $clientSecret = trim((string) ($data['client_secret'] ?? ''));

        if (! filled($clientSecret) && ! $settings->exists) {
            throw ValidationException::withMessages([
                'data.client_secret' => 'Enter the Google OAuth client secret to enable Google sign-in.',
            ]);
        }

        $settings->client_id = trim($data['client_id']);

        if (filled($clientSecret)) {
            $settings->client_secret = $clientSecret;
        }

        $settings->save();

        Notification::make()
            ->title('Google sign-in settings saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }
}
