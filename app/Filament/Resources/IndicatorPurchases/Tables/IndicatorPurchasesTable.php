<?php

namespace App\Filament\Resources\IndicatorPurchases\Tables;

use App\Models\IndicatorPurchase;
use App\Services\IndicatorAccessDelivery;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Throwable;

class IndicatorPurchasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('indicator_name')
                    ->label('Indicator')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('amount_cents')
                    ->label('Amount')
                    ->formatStateUsing(fn (int $state): string => '$' . number_format($state / 100, 2)),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'access_sent' => 'success',
                        'paid' => 'info',
                        'payment_failed', 'checkout_expired' => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('paid_at')
                    ->dateTime()
                    ->placeholder('Not paid')
                    ->sortable(),
                TextColumn::make('access_sent_at')
                    ->dateTime()
                    ->placeholder('Awaiting approval'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('approveAndSendAccess')
                    ->label('Approve & send access')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->form([
                        TextInput::make('subject')
                            ->required()
                            ->default(fn (): string => app(IndicatorAccessDelivery::class)->template()['subject']),
                        RichEditor::make('body')
                            ->required()
                            ->default(fn (): string => app(IndicatorAccessDelivery::class)->template()['body'])
                            ->helperText('Personalize this email for this user. Placeholders: {{indicator_name}}, {{access_url}}, {{delivery_type}}, {{recipient_email}}.'),
                    ])
                    ->requiresConfirmation()
                    ->visible(fn (IndicatorPurchase $record): bool => $record->status === 'paid')
                    ->action(function (IndicatorPurchase $record, array $data): void {
                        try {
                            app(IndicatorAccessDelivery::class)->sendPaidPurchaseAccess($record, $data);

                            Notification::make()->title('Access email sent')->success()->send();
                        } catch (Throwable $exception) {
                            report($exception);
                            Notification::make()->title('Access email could not be sent')->body($exception->getMessage())->danger()->send();
                        }
                    }),
            ]);
    }
}
