<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\IndicatorPurchase;
use App\Services\StripeCredentials;
use App\Services\StripeCheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class IndicatorCheckoutController
{
    public function store(Request $request, Indicator $indicator, StripeCheckoutService $stripe, StripeCredentials $credentials): RedirectResponse
    {
        abort_unless($indicator->is_active && $indicator->is_paid, 404);

        $data = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        if ($indicator->price_cents < 50) {
            return back()->withErrors(['checkout' => 'This indicator does not have a valid paid price yet.']);
        }

        $purchase = IndicatorPurchase::create([
            'indicator_id' => $indicator->id,
            'indicator_name' => $indicator->name,
            'email' => $data['email'],
            'amount_cents' => $indicator->price_cents,
            'currency' => 'usd',
            'stripe_environment' => $credentials->active()['environment'],
            'status' => 'checkout_pending',
        ]);

        try {
            $session = $stripe->createSession($purchase, $indicator);
            $purchase->forceFill(['stripe_session_id' => $session->id])->save();

            return redirect()->away($session->url);
        } catch (Throwable $exception) {
            report($exception);
            $purchase->forceFill(['status' => 'checkout_failed'])->save();

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['checkout' => 'Secure checkout is temporarily unavailable. Please try again later.']);
        }
    }

    public function success(Request $request, IndicatorPurchase $purchase, StripeCheckoutService $stripe): View
    {
        $sessionId = $request->query('session_id');

        abort_unless(
            is_string($sessionId)
            && $purchase->stripe_session_id
            && hash_equals($purchase->stripe_session_id, $sessionId),
            404,
        );

        try {
            $stripe->verifySuccessReturn($purchase, $sessionId);
        } catch (Throwable $exception) {
            report($exception);
        }

        return view('indicators.payment-result', [
            'purchase' => $purchase->fresh(),
        ])->layout('layout.app');
    }
}
