<?php

namespace App\Services;

use App\Mail\FreeIndicatorRequestReceived;
use App\Mail\IndicatorAccessLink;
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

        if (!$adminEmail) {
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

    public function sendFreeRequestAccess(IndicatorAccessRequest $request): void
    {
        $request->loadMissing('indicator');
        $indicator = $request->indicator;

        if ($request->status !== 'new' || !$indicator || $indicator->is_paid || !$indicator->trading_view_url) {
            throw new RuntimeException('This request is no longer eligible for free access or has no access URL configured.');
        }

        Mail::to($request->email)->send(new IndicatorAccessLink(
            indicatorName: $indicator->name,
            accessUrl: $indicator->trading_view_url,
            deliveryType: 'free request',
        ));

        $request->forceFill(['status' => 'access_sent'])->save();
    }

    public function sendPaidPurchaseAccess(IndicatorPurchase $purchase): void
    {
        $purchase->loadMissing('indicator');
        $indicator = $purchase->indicator;

        if ($purchase->status !== 'paid' || !$indicator || !$indicator->is_paid || !$indicator->trading_view_url) {
            throw new RuntimeException('The payment must be verified and the indicator access URL must be configured before delivery.');
        }

        Mail::to($purchase->email)->send(new IndicatorAccessLink(
            indicatorName: $purchase->indicator_name,
            accessUrl: $indicator->trading_view_url,
            deliveryType: 'paid purchase',
        ));

        $purchase->forceFill([
            'status' => 'access_sent',
            'access_sent_at' => now(),
        ])->save();
    }
}
