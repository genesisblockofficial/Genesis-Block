<?php

namespace App\Filament\Pages;

use App\Models\EconomicCalendarSettings as EconomicCalendarSettingsModel;
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

class EconomicCalendarSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog;

    protected static ?string $navigationLabel = 'Economic Calendar';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.economic-calendar-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public bool $apiKeyConfigured = false;

    public function mount(): void
    {
        $settings = EconomicCalendarSettingsModel::query()->first();

        $this->settingsId = $settings?->id;
        $this->apiKeyConfigured = filled($settings?->api_key);

        $this->form->fill([
            'enabled' => $settings?->enabled ?? true,
            'api_key' => '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Live economic calendar')
                    ->description('The public News page fetches events through the secure server-side proxy. Leave the key field empty to keep the saved key.')
                    ->schema([
                        Toggle::make('enabled')
                            ->label('Show live events on the public News page')
                            ->default(true),
                        TextInput::make('api_key')
                            ->label('Finnhub API key')
                            ->password()
                            ->placeholder($this->apiKeyConfigured ? 'Saved; enter only to rotate' : 'Paste your Finnhub API key')
                            ->helperText($this->apiKeyConfigured ? 'A key is already saved. Enter a new value only when rotating it.' : 'Required when live events are enabled.'),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? EconomicCalendarSettingsModel::query()->findOrFail($this->settingsId)
            : new EconomicCalendarSettingsModel();
        $newApiKey = trim((string) ($data['api_key'] ?? ''));

        if ((bool) ($data['enabled'] ?? false) && !filled($newApiKey) && !filled($settings->api_key)) {
            throw ValidationException::withMessages([
                'data.api_key' => 'Add a Finnhub API key before enabling live events.',
            ]);
        }

        $settings->enabled = (bool) ($data['enabled'] ?? false);
        if (filled($newApiKey)) {
            $settings->api_key = $newApiKey;
        }
        $settings->save();

        Notification::make()
            ->title('Economic calendar settings saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }
}
