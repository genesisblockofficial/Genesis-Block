<?php

namespace App\Services;

use App\Models\Indicator;
use App\Models\IndicatorPurchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Checkout\Session;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeCheckoutService
{
    public function __construct(private StripeCredentials $credentials) {}

    public function createSession(IndicatorPurchase $purchase, Indicator $indicator): Session
    {
        $session = $this->client($purchase->stripe_environment)->checkout->sessions->create([
            'mode' => 'payment',
            'currency' => 'usd',
            'customer_email' => $purchase->email,
            'client_reference_id' => (string) $purchase->id,
            'success_url' => route('indicators.payment-result', $purchase) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('indicators.index', ['payment' => 'cancelled']),
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $purchase->amount_cents,
                    'product_data' => [
                        'name' => $indicator->name,
                        'description' => $indicator->summary ?: 'TradingView indicator access',
                    ],
                ],
            ]],
            'metadata' => [
                'purchase_id' => (string) $purchase->id,
                'indicator_id' => (string) $indicator->id,
            ],
        ], [
            'idempotency_key' => 'indicator-purchase-' . $purchase->id,
        ]);

        if (!$session->url) {
            throw new RuntimeException('Stripe did not return a Checkout URL.');
        }

        return $session;
    }

    public function verifySuccessReturn(IndicatorPurchase $purchase, string $sessionId): void
    {
        if (!$purchase->stripe_session_id || !hash_equals($purchase->stripe_session_id, $sessionId)) {
            throw new RuntimeException('The checkout session does not match this purchase.');
        }

        $session = $this->client($purchase->stripe_environment)->checkout->sessions->retrieve($sessionId);
        $this->recordPaidSession($session);
    }

    public function processWebhook(string $payload, string $signature): void
    {
        $event = null;
        $signatureException = null;

        foreach ($this->credentials->webhookSecrets() as $endpointSecret) {
            try {
                $event = Webhook::constructEvent($payload, $signature, $endpointSecret);
                break;
            } catch (SignatureVerificationException $exception) {
                $signatureException = $exception;
            }
        }

        if (!$event) {
            if ($signatureException) {
                throw $signatureException;
            }

            throw new RuntimeException('No Stripe webhook signing secret is configured.');
        }

        $session = $event->data->object;

        match ($event->type) {
            'checkout.session.completed', 'checkout.session.async_payment_succeeded' => $this->recordPaidSession($session),
            'checkout.session.expired' => $this->recordSessionStatus($session, 'checkout_expired'),
            'checkout.session.async_payment_failed' => $this->recordSessionStatus($session, 'payment_failed'),
            default => null,
        };
    }

    private function recordPaidSession(object $session): void
    {
        if (($session->payment_status ?? null) !== 'paid') {
            return;
        }

        DB::transaction(function () use ($session): void {
            $purchase = IndicatorPurchase::query()
                ->where('stripe_session_id', $session->id ?? '')
                ->lockForUpdate()
                ->first();

            if (!$purchase) {
                Log::warning('Stripe completed an unknown indicator purchase.', [
                    'checkout_session_id' => $session->id ?? null,
                ]);

                return;
            }

            $metadataPurchaseId = (string) ($session->metadata->purchase_id ?? '');
            $currency = strtolower((string) ($session->currency ?? ''));
            $environment = ($session->livemode ?? false) ? 'live' : 'test';

            if (
                $metadataPurchaseId !== (string) $purchase->id
                || (int) ($session->amount_total ?? -1) !== $purchase->amount_cents
                || $currency !== strtolower($purchase->currency)
                || $environment !== $purchase->stripe_environment
            ) {
                Log::critical('Stripe Checkout details did not match the stored indicator purchase.', [
                    'purchase_id' => $purchase->id,
                    'checkout_session_id' => $session->id ?? null,
                ]);

                return;
            }

            if (in_array($purchase->status, ['paid', 'access_sent'], true)) {
                return;
            }

            $paymentIntent = $session->payment_intent ?? null;
            $paymentIntentId = is_string($paymentIntent) ? $paymentIntent : ($paymentIntent->id ?? null);

            $purchase->forceFill([
                'status' => 'paid',
                'stripe_payment_intent_id' => $paymentIntentId,
                'paid_at' => now(),
            ])->save();
        });
    }

    private function recordSessionStatus(object $session, string $status): void
    {
        IndicatorPurchase::query()
            ->where('stripe_session_id', $session->id ?? '')
            ->where('status', 'checkout_pending')
            ->update(['status' => $status]);
    }

    private function client(string $environment): StripeClient
    {
        $secret = $this->credentials->forEnvironment($environment)['secret'];

        if (!$secret) {
            throw new RuntimeException('Stripe credentials for ' . $environment . ' mode are not configured in Admin → Stripe Settings.');
        }

        return new StripeClient($secret);
    }
}
