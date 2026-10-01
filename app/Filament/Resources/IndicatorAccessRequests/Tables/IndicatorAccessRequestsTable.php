<?php

namespace App\Filament\Resources\IndicatorAccessRequests\Tables;

use App\Models\IndicatorAccessRequest;
use App\Services\IndicatorAccessDelivery;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Throwable;

class IndicatorAccessRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('indicator_name')
                    ->label('Indicator')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->placeholder('Not provided'),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'access_sent' ? 'success' : ($state === 'closed' ? 'gray' : 'warning')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('sendAccess')
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
                    ->visible(fn (IndicatorAccessRequest $record): bool => $record->status === 'new')
                    ->action(function (IndicatorAccessRequest $record, array $data): void {
                        try {
                            app(IndicatorAccessDelivery::class)->sendFreeRequestAccess($record, $data);

                            Notification::make()->title('Access email sent')->success()->send();
                        } catch (Throwable $exception) {
                            report($exception);
                            Notification::make()->title('Access email could not be sent')->body($exception->getMessage())->danger()->send();
                        }
                    }),
                DeleteAction::make(),
            ]);
    }
}
