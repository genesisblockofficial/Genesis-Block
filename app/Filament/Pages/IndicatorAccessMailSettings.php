<?php

namespace App\Filament\Pages;

use App\Models\IndicatorAccessMailSettings as IndicatorAccessMailSettingsModel;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class IndicatorAccessMailSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $navigationLabel = 'Access Email Template';

    protected static string|UnitEnum|null $navigationGroup = 'Website CRM';

    protected string $view = 'filament.pages.indicator-access-mail-settings';

    public ?array $data = [];

    public ?int $settingsId = null;

    public function mount(): void
    {
        $settings = IndicatorAccessMailSettingsModel::query()->first();
        $this->settingsId = $settings?->id;

        $this->form->fill([
            'subject' => $settings?->subject ?? 'Your indicator access: {{indicator_name}}',
            'body' => $settings?->body ?? $this->defaultBody(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Section::make('Access email template')
                    ->description('This template is used when an admin approves a free request or sends access after a paid indicator purchase.')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Email subject')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('body')
                            ->label('Email content')
                            ->required()
                            ->helperText('Available placeholders: {{indicator_name}}, {{access_url}}, {{delivery_type}}, {{recipient_email}}.'),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = $this->settingsId
            ? IndicatorAccessMailSettingsModel::query()->findOrFail($this->settingsId)
            : new IndicatorAccessMailSettingsModel();

        $settings->subject = $data['subject'];
        $settings->body = $data['body'];
        $settings->save();

        Notification::make()
            ->title('Access email template saved')
            ->success()
            ->send();

        $this->settingsId = $settings->id;
        $this->mount();
    }

    private function defaultBody(): string
    {
        return '<p>Hello,</p><p>Your <strong>{{delivery_type}}</strong> for <strong>{{indicator_name}}</strong> has been approved.</p><p><a href="{{access_url}}">Open TradingView access</a></p><p>If the button does not open, use this link: {{access_url}}</p><p>Trading setups and indicators are educational material, not financial advice. Review the risks before making trading decisions.</p>';
    }
}
