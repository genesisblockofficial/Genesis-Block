<?php

namespace App\Filament\Pages;

use App\Models\StripeSettings as StripeSettingsModel;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\ValidationException;
use UnitEnum;

class StripeSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog;

    protected static ?string $navigationLabel = 'Stripe Settings';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.stripe-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public bool $testSecretConfigured = false;

    public bool $testWebhookConfigured = false;

    public bool $liveSecretConfigured = false;

    public bool $liveWebhookConfigured = false;

    public function mount(): void
    {
        $settings = $this->settingsId
            ? StripeSettingsModel::query()->find($this->settingsId)
            : StripeSettingsModel::query()->first();

        $this->settingsId = $settings?->id;
        $this->testSecretConfigured = filled($settings?->test_secret_key);
        $this->testWebhookConfigured = filled($settings?->test_webhook_secret);
        $this->liveSecretConfigured = filled($settings?->live_secret_key);
        $this->liveWebhookConfigured = filled($settings?->live_webhook_secret);

        $this->form->fill([
            'active_environment' => $settings?->active_environment ?? 'test',
            'test_publishable_key' => $settings?->test_publishable_key,
            'test_secret_key' => '',
            'test_webhook_secret' => '',
            'remove_test_credentials' => false,
            'live_publishable_key' => $settings?->live_publishable_key,
            'live_secret_key' => '',
            'live_webhook_secret' => '',
            'remove_live_credentials' => false,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Active environment')
                    ->description('Checkout uses the selected environment. Existing orders retain the environment they started in.')
                    ->schema([
                        Select::make('active_environment')
                            ->options([
                                'test' => 'Test mode',
                                'live' => 'Live mode',
                            ])
                            ->required(),
                    ]),
                Section::make('Test mode credentials')
                    ->description('Keys are encrypted in the database. Saved secrets are never shown; leave secret fields empty to keep their current values.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('test_publishable_key')
                            ->label('Publishable key')
                            ->placeholder('pk_test_...'),
                        TextInput::make('test_secret_key')
                            ->label('Secret key')
                            ->password()
                            ->placeholder($this->testSecretConfigured ? 'Saved; enter only to rotate' : 'sk_test_...')
                            ->helperText($this->testSecretConfigured ? 'A secret is already saved.' : 'Not configured.'),
                        TextInput::make('test_webhook_secret')
                            ->label('Webhook signing secret')
                            ->password()
                            ->placeholder($this->testWebhookConfigured ? 'Saved; enter only to rotate' : 'whsec_...')
                            ->helperText($this->testWebhookConfigured ? 'A signing secret is already saved.' : 'Not configured.'),
                        Toggle::make('remove_test_credentials')
                            ->label('Remove test secret and webhook credentials')
                            ->columnSpanFull(),
                    ]),
                Section::make('Live mode credentials')
                    ->description('Use live keys only after test checkout and webhook verification have passed.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('live_publishable_key')
                            ->label('Publishable key')
                            ->placeholder('pk_live_...'),
                        TextInput::make('live_secret_key')
                            ->label('Secret key')
                            ->password()
                            ->placeholder($this->liveSecretConfigured ? 'Saved; enter only to rotate' : 'sk_live_...')
                            ->helperText($this->liveSecretConfigured ? 'A secret is already saved.' : 'Not configured.'),
                        TextInput::make('live_webhook_secret')
                            ->label('Webhook signing secret')
                            ->password()
                            ->placeholder($this->liveWebhookConfigured ? 'Saved; enter only to rotate' : 'whsec_...')
                            ->helperText($this->liveWebhookConfigured ? 'A signing secret is already saved.' : 'Not configured.'),
                        Toggle::make('remove_live_credentials')
                            ->label('Remove live secret and webhook credentials')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? StripeSettingsModel::query()->findOrFail($this->settingsId)
            : new StripeSettingsModel();
        $environment = $data['active_environment'];
        $prefix = $environment . '_';
        $removingActiveCredentials = (bool) ($data['remove_' . $environment . '_credentials'] ?? false);
        $newSecret = trim((string) ($data[$prefix . 'secret_key'] ?? ''));
        $newWebhookSecret = trim((string) ($data[$prefix . 'webhook_secret'] ?? ''));
        $savedSecret = $environment === 'test' ? $settings->test_secret_key : $settings->live_secret_key;
        $savedWebhookSecret = $environment === 'test' ? $settings->test_webhook_secret : $settings->live_webhook_secret;

        if ($removingActiveCredentials || (!filled($newSecret) && !filled($savedSecret))) {
            throw ValidationException::withMessages([
                'data.active_environment' => 'Add a secret key before activating this Stripe environment.',
            ]);
        }

        if ($removingActiveCredentials || (!filled($newWebhookSecret) && !filled($savedWebhookSecret))) {
            throw ValidationException::withMessages([
                'data.active_environment' => 'Add a webhook signing secret before activating this Stripe environment.',
            ]);
        }

        $settings->active_environment = $environment;
        $settings->test_publishable_key = $data['test_publishable_key'] ?? null;
        $settings->live_publishable_key = $data['live_publishable_key'] ?? null;

        foreach (['test', 'live'] as $credentialEnvironment) {
            $removeCredentials = (bool) ($data['remove_' . $credentialEnvironment . '_credentials'] ?? false);

            foreach (['secret_key', 'webhook_secret'] as $credentialName) {
                $field = $credentialEnvironment . '_' . $credentialName;
                $newValue = trim((string) ($data[$field] ?? ''));

                if ($removeCredentials) {
                    $settings->{$field} = null;
                } elseif (filled($newValue)) {
                    $settings->{$field} = $newValue;
                }
            }
        }

        $settings->save();

        Notification::make()
            ->title('Stripe settings saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }
}
