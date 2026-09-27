<?php

use App\Mail\FreeIndicatorRequestReceived;
use App\Mail\IndicatorAccessLink;
use App\Models\Indicator;
use App\Models\IndicatorAccessRequest;
use App\Models\IndicatorPurchase;
use App\Services\IndicatorAccessDelivery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

function makeIndicatorRecord(array $overrides = []): Indicator
{
    return Indicator::create(array_merge([
        'name' => 'Example Indicator',
        'slug' => 'example-indicator',
        'summary' => 'A test indicator.',
        'description' => 'Test description.',
        'is_paid' => false,
        'price_cents' => 0,
        'trading_view_url' => 'https://www.tradingview.com/script/private-example/',
        'is_active' => true,
        'sort_order' => 1,
    ], $overrides));
}

function makeStripeTestSignature(string $payload, string $secret): string
{
    $timestamp = time();
    $signature = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);

    return 't=' . $timestamp . ',v1=' . $signature;
}

test('free access requests are stored and notify the configured admin', function () {
    Mail::fake();
    config(['services.indicator_access.admin_email' => 'admin@example.test']);
    $indicator = makeIndicatorRecord();

    $response = $this->post(route('indicators.free-request', $indicator, false), [
        'name' => 'Alex Example',
        'email' => 'alex@example.test',
        'message' => 'I would like to learn more.',
    ]);

    $response->assertRedirect(route('indicators.index'))
        ->assertSessionHas('access_request_sent');

    $request = IndicatorAccessRequest::query()->sole();
    expect($request->status)->toBe('new')
        ->and($request->notified_at)->not->toBeNull();

    Mail::assertSent(FreeIndicatorRequestReceived::class, fn (FreeIndicatorRequestReceived $mail): bool =>
        $mail->requesterEmail === 'alex@example.test'
        && $mail->indicatorName === 'Example Indicator'
    );
});

test('a verified stripe checkout webhook marks only the matching paid order as paid', function () {
    $indicator = makeIndicatorRecord([
        'is_paid' => true,
        'price_cents' => 2500,
    ]);
    $purchase = IndicatorPurchase::create([
        'indicator_id' => $indicator->id,
        'indicator_name' => $indicator->name,
        'email' => 'buyer@example.test',
        'amount_cents' => 2500,
        'currency' => 'usd',
        'stripe_session_id' => 'cs_test_indicator_123',
        'status' => 'checkout_pending',
    ]);
    config(['services.stripe.webhook_secret' => 'whsec_feature_test']);

    $payload = json_encode([
        'id' => 'evt_test_indicator_paid',
        'object' => 'event',
        'type' => 'checkout.session.completed',
        'data' => [
            'object' => [
                'id' => 'cs_test_indicator_123',
                'object' => 'checkout.session',
                'payment_status' => 'paid',
                'amount_total' => 2500,
                'currency' => 'usd',
                'payment_intent' => 'pi_test_indicator_123',
                'metadata' => ['purchase_id' => (string) $purchase->id],
            ],
        ],
    ], JSON_THROW_ON_ERROR);
    $signature = makeStripeTestSignature($payload, 'whsec_feature_test');

    $response = $this->call('POST', route('stripe.webhook', [], false), [], [], [], [
        'CONTENT_TYPE' => 'application/json',
        'HTTP_STRIPE_SIGNATURE' => $signature,
    ], $payload);

    $response->assertOk();
    expect($purchase->fresh()->status)->toBe('paid')
        ->and($purchase->fresh()->stripe_payment_intent_id)->toBe('pi_test_indicator_123')
        ->and($purchase->fresh()->access_sent_at)->toBeNull();
});

test('a checkout amount mismatch does not mark a purchase paid', function () {
    $indicator = makeIndicatorRecord(['is_paid' => true, 'price_cents' => 2500]);
    $purchase = IndicatorPurchase::create([
        'indicator_id' => $indicator->id,
        'indicator_name' => $indicator->name,
        'email' => 'buyer@example.test',
        'amount_cents' => 2500,
        'currency' => 'usd',
        'stripe_session_id' => 'cs_test_wrong_amount',
        'status' => 'checkout_pending',
    ]);
    config(['services.stripe.webhook_secret' => 'whsec_feature_test']);

    $payload = json_encode([
        'id' => 'evt_test_wrong_amount',
        'object' => 'event',
        'type' => 'checkout.session.completed',
        'data' => [
            'object' => [
                'id' => 'cs_test_wrong_amount',
                'object' => 'checkout.session',
                'payment_status' => 'paid',
                'amount_total' => 100,
                'currency' => 'usd',
                'metadata' => ['purchase_id' => (string) $purchase->id],
            ],
        ],
    ], JSON_THROW_ON_ERROR);
    $signature = makeStripeTestSignature($payload, 'whsec_feature_test');

    $this->call('POST', route('stripe.webhook', [], false), [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_STRIPE_SIGNATURE' => $signature,
        ], $payload)
        ->assertOk();

    expect($purchase->fresh()->status)->toBe('checkout_pending');
});

test('invalid stripe webhook signatures are rejected', function () {
    config(['services.stripe.webhook_secret' => 'whsec_feature_test']);

    $this->call('POST', route('stripe.webhook', [], false), [], [], [], [
        'CONTENT_TYPE' => 'application/json',
        'HTTP_STRIPE_SIGNATURE' => 't=' . time() . ',v1=invalid',
    ], '{"id":"evt_invalid","object":"event","type":"checkout.session.completed","data":{"object":{}}}')
        ->assertStatus(400);
});

test('checkout does not create a paid order when stripe is unconfigured', function () {
    config(['services.stripe.secret' => null]);
    $indicator = makeIndicatorRecord(['is_paid' => true, 'price_cents' => 2500]);

    $response = $this->from(route('indicators.index', [], false))
        ->post(route('indicators.checkout', $indicator, false), [
            'email' => 'buyer@example.test',
        ]);

    $response->assertRedirect(route('indicators.index'))
        ->assertSessionHasErrors('checkout');

    expect(IndicatorPurchase::query()->sole()->status)->toBe('checkout_failed');
});

test('private tradingview access urls are never rendered on the public catalog', function () {
    $indicator = makeIndicatorRecord([
        'trading_view_url' => 'https://www.tradingview.com/script/private-do-not-display/',
    ]);

    $this->get(route('indicators.index', [], false))
        ->assertOk()
        ->assertSee($indicator->name)
        ->assertDontSee($indicator->trading_view_url);
});

test('paid access is emailed only after explicit admin approval', function () {
    Mail::fake();
    $indicator = makeIndicatorRecord(['is_paid' => true, 'price_cents' => 2500]);
    $purchase = IndicatorPurchase::create([
        'indicator_id' => $indicator->id,
        'indicator_name' => $indicator->name,
        'email' => 'buyer@example.test',
        'amount_cents' => 2500,
        'currency' => 'usd',
        'stripe_session_id' => 'cs_test_approved',
        'status' => 'paid',
        'paid_at' => now(),
    ]);

    app(IndicatorAccessDelivery::class)->sendPaidPurchaseAccess($purchase);

    Mail::assertSent(IndicatorAccessLink::class, fn (IndicatorAccessLink $mail): bool =>
        $mail->hasTo('buyer@example.test')
        && $mail->accessUrl === $indicator->trading_view_url
        && $mail->deliveryType === 'paid purchase'
    );

    expect($purchase->fresh()->status)->toBe('access_sent')
        ->and($purchase->fresh()->access_sent_at)->not->toBeNull();
});
