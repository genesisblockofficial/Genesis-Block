<?php

namespace App\Services;

use App\Mail\FreeIndicatorRequestReceived;
use App\Mail\IndicatorAccessLink;
use App\Models\IndicatorAccessMailSettings;
use App\Models\IndicatorAccessRequest;
use App\Models\IndicatorPurchase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class IndicatorAccessDelivery
{
    public function notifyAdminOfFreeRequest(IndicatorAccessRequest $request): void
    {
        $adminEmail = config('services.indicator_access.admin_email');

        if (! $adminEmail) {
            Log::warning('Free indicator request received but INDICATOR_ADMIN_EMAIL is not configured.', [
                'request_id' => $request->id,
                'email' => $request->email,
            ]);

            return;
        }

        Mail::to($adminEmail)->send(new FreeIndicatorRequestReceived(
            indicatorName: $request->indicator_name,
            requesterName: $request->name,
            requesterEmail: $request->email,
            requestMessage: $request->message,
            adminUrl: route('filament.admin.resources.indicator-access-requests.index'),
        ));

        $request->forceFill(['notified_at' => now()])->save();
    }

    public function sendFreeRequestAccess(IndicatorAccessRequest $request, ?array $template = null): void
    {
        $request->loadMissing('indicator');
        $indicator = $request->indicator;

        if ($request->status !== 'new' || ! $indicator || $indicator->is_paid || ! $indicator->trading_view_url) {
            throw new RuntimeException('This request is no longer eligible for free access or has no access URL configured.');
        }

        $this->sendAccessMail($request->email, $indicator->name, $indicator->trading_view_url, 'free request', $template);

        $request->forceFill(['status' => 'access_sent'])->save();
    }

    public function sendPaidPurchaseAccess(IndicatorPurchase $purchase, ?array $template = null): void
    {
        $purchase->loadMissing('indicator');
        $indicator = $purchase->indicator;

        if ($purchase->status !== 'paid' || ! $indicator || ! $indicator->is_paid || ! $indicator->trading_view_url) {
            throw new RuntimeException('The payment must be verified and the indicator access URL must be configured before delivery.');
        }

        $this->sendAccessMail($purchase->email, $purchase->indicator_name, $indicator->trading_view_url, 'paid purchase', $template);

        $purchase->forceFill([
            'status' => 'access_sent',
            'access_sent_at' => now(),
        ])->save();
    }

    public function template(): array
    {
        $settings = IndicatorAccessMailSettings::query()->first();

        return [
            'subject' => $settings?->subject ?: 'Your indicator access: {{indicator_name}}',
            'body' => $settings?->body ?: '<p>Your <strong>{{delivery_type}}</strong> for <strong>{{indicator_name}}</strong> has been approved.</p><p><a href="{{access_url}}">Open TradingView access</a></p>',
        ];
    }

    private function sendAccessMail(string $recipientEmail, string $indicatorName, string $accessUrl, string $deliveryType, ?array $template = null): void
    {
        app(MailTransportConfiguration::class)->applySavedSettings();

        $mailer = config('mail.default');
        $configuredMailers = in_array($mailer, ['failover', 'roundrobin'], true)
            ? config("mail.mailers.{$mailer}.mailers", [])
            : [$mailer];

        if (array_intersect($configuredMailers, ['log', 'array'])) {
            throw new RuntimeException('Email delivery is not configured. Set MAIL_MAILER and valid provider settings before approving access.');
        }

        $template ??= $this->template();
        $subject = $template['subject'];
        $body = $template['body'];
        $values = [
            '{{indicator_name}}' => e($indicatorName),
            '{{access_url}}' => e($accessUrl),
            '{{delivery_type}}' => e($deliveryType),
            '{{recipient_email}}' => e($recipientEmail),
        ];

        Mail::to($recipientEmail)->send(new IndicatorAccessLink(
            indicatorName: $indicatorName,
            accessUrl: $accessUrl,
            deliveryType: $deliveryType,
            subject: str_replace(array_keys($values), array_values($values), $subject),
            body: str_replace(array_keys($values), array_values($values), $body),
            recipientEmail: $recipientEmail,
        ));
    }
}
