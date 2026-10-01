<?php

namespace App\Filament\Pages;

use App\Models\SmtpMailSettings as SmtpMailSettingsModel;
use App\Services\MailTransportConfiguration;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;
use UnitEnum;

class MailProviderSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $navigationLabel = 'Mail Provider';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.mail-provider-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public bool $passwordConfigured = false;

    public function mount(): void
    {
        $settings = $this->settingsId
            ? SmtpMailSettingsModel::query()->find($this->settingsId)
            : SmtpMailSettingsModel::query()->first();

        $this->settingsId = $settings?->id;
        $this->passwordConfigured = filled($settings?->password);

        $this->form->fill([
            'host' => $settings?->host,
            'port' => $settings?->port ?? 587,
            'scheme' => $settings?->scheme ?? 'smtp',
            'username' => $settings?->username,
            'password' => '',
            'remove_password' => false,
            'from_address' => $settings?->from_address ?? config('mail.from.address'),
            'from_name' => $settings?->from_name ?? config('mail.from.name'),
            'test_email' => '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('SMTP connection')
                    ->description('Use your provider’s SMTP details. Passwords are encrypted in the database and never shown after saving.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('host')
                            ->label('SMTP host')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('smtp.example.com'),
                        TextInput::make('port')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(65535)
                            ->required()
                            ->default(587),
                        Select::make('scheme')
                            ->label('Connection security')
                            ->options([
                                'smtp' => 'STARTTLS / automatic TLS',
                                'smtps' => 'Implicit TLS (usually port 465)',
                            ])
                            ->required(),
                        TextInput::make('username')
                            ->label('SMTP username')
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label('SMTP password')
                            ->password()
                            ->revealable()
                            ->placeholder($this->passwordConfigured ? 'Saved; enter only to change' : 'Enter provider password')
                            ->helperText($this->passwordConfigured ? 'A password is saved.' : 'Optional for providers without SMTP authentication.'),
                        Toggle::make('remove_password')
                            ->label('Remove saved SMTP password')
                            ->columnSpanFull(),
                    ]),
                Section::make('Sender and test')
                    ->columns(2)
                    ->schema([
                        TextInput::make('from_address')
                            ->label('From email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('from_name')
                            ->label('From name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('test_email')
                            ->label('Send test email to')
                            ->email()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? SmtpMailSettingsModel::query()->findOrFail($this->settingsId)
            : new SmtpMailSettingsModel;

        $settings->host = trim($data['host']);
        $settings->port = (int) $data['port'];
        $settings->scheme = $data['scheme'];
        $settings->username = filled($data['username'] ?? null) ? trim($data['username']) : null;
        $settings->from_address = trim($data['from_address']);
        $settings->from_name = trim($data['from_name']);

        if ($data['remove_password'] ?? false) {
            $settings->password = null;
        } elseif (filled($data['password'] ?? null)) {
            $settings->password = $data['password'];
        } elseif (! $settings->exists && filled($settings->username)) {
            throw ValidationException::withMessages([
                'data.password' => 'Enter the SMTP password for this username.',
            ]);
        }

        $settings->save();

        Notification::make()
            ->title('Mail provider settings saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }

    public function sendTestEmail(): void
    {
        $data = $this->form->getState();

        if (! filter_var($data['test_email'] ?? null, FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages([
                'data.test_email' => 'Enter a valid recipient email for the test.',
            ]);
        }

        if (! app(MailTransportConfiguration::class)->applySavedSettings()) {
            Notification::make()
                ->title('Save SMTP settings before sending a test')
                ->warning()
                ->send();

            return;
        }

        try {
            Mail::raw('Your Genesis Block SMTP settings are working.', function ($message) use ($data): void {
                $message->to($data['test_email'])->subject('Genesis Block mail test');
            });

            Notification::make()
                ->title('Test email sent')
                ->body('Check the recipient inbox and spam folder.')
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title('Test email could not be sent')
                ->body('Check the SMTP host, port, security mode and credentials.')
                ->danger()
                ->send();
        }
    }
}
