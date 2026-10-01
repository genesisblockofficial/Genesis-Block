<?php

use App\Mail\FreeIndicatorRequestReceived;
use App\Mail\IndicatorAccessLink;
use App\Models\Indicator;
use App\Models\IndicatorAccessRequest;
use App\Models\IndicatorPurchase;
use App\Models\SmtpMailSettings;
use App\Models\StripeSettings;
use App\Models\User;
use App\Services\IndicatorAccessDelivery;
use App\Services\MailTransportConfiguration;
use App\Services\StripeCheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session as StripeCheckoutSession;

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
    $signature = hash_hmac('sha256', $timestamp.'.'.$payload, $secret);

    return 't='.$timestamp.',v1='.$signature;
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

    Mail::assertSent(FreeIndicatorRequestReceived::class, fn (FreeIndicatorRequestReceived $mail): bool => $mail->requesterEmail === 'alex@example.test'
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
        'HTTP_STRIPE_SIGNATURE' => 't='.time().',v1=invalid',
    ], '{"id":"evt_invalid","object":"event","type":"checkout.session.completed","data":{"object":{}}}')
        ->assertStatus(400);
});

test('checkout does not create a paid order when stripe is unconfigured', function () {
    config(['services.stripe.secret' => null]);
    $indicator = makeIndicatorRecord(['is_paid' => true, 'price_cents' => 2500]);
    $user = User::create([
        'first_name' => 'Test',
        'last_name' => 'Buyer',
        'email' => 'buyer@example.test',
        'password' => 'password',
    ]);

    $response = $this->actingAs($user)
        ->from(route('indicators.index', [], false))
        ->post(route('indicators.checkout', $indicator, false), [
            'email' => 'buyer@example.test',
        ]);

    $response->assertRedirect(route('indicators.index'))
        ->assertSessionHasErrors('checkout', 'Secure checkout is not configured yet. An admin must add a Stripe secret key under Admin → Stripe Settings.');

    expect(IndicatorPurchase::query()->count())->toBe(0);
});

test('checkout redirects to stripe with a test secret even when webhook is not configured yet', function () {
    $indicator = makeIndicatorRecord(['is_paid' => true, 'price_cents' => 2500]);
    $user = User::create([
        'first_name' => 'Test',
        'last_name' => 'Buyer',
        'email' => 'buyer@example.test',
        'password' => 'password',
    ]);
    StripeSettings::create([
        'active_environment' => 'test',
        'test_secret_key' => 'sk_test_checkout',
    ]);

    $stripeSession = StripeCheckoutSession::constructFrom([
        'id' => 'cs_test_checkout',
        'url' => 'https://checkout.stripe.com/c/pay/cs_test_checkout',
    ]);

    $stripe = Mockery::mock(StripeCheckoutService::class);
    $stripe->shouldReceive('createSession')
        ->once()
        ->andReturn($stripeSession);
    $this->app->instance(StripeCheckoutService::class, $stripe);

    $this->actingAs($user)
        ->post(route('indicators.checkout', $indicator, false), [
            'email' => 'buyer@example.test',
        ])
        ->assertRedirect('https://checkout.stripe.com/c/pay/cs_test_checkout');

    expect(IndicatorPurchase::query()->sole()->status)->toBe('checkout_pending')
        ->and(IndicatorPurchase::query()->sole()->stripe_session_id)->toBe('cs_test_checkout');
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
    config(['mail.default' => 'smtp']);
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

    Mail::assertSent(IndicatorAccessLink::class, fn (IndicatorAccessLink $mail): bool => $mail->hasTo('buyer@example.test')
        && $mail->accessUrl === $indicator->trading_view_url
        && $mail->deliveryType === 'paid purchase'
    );

    expect($purchase->fresh()->status)->toBe('access_sent')
        ->and($purchase->fresh()->access_sent_at)->not->toBeNull();
});

test('free access request stays pending when mail is configured to log only', function () {
    config(['mail.default' => 'log']);
    $indicator = makeIndicatorRecord();
    $accessRequest = IndicatorAccessRequest::create([
        'indicator_id' => $indicator->id,
        'indicator_name' => $indicator->name,
        'email' => 'requester@example.test',
        'status' => 'new',
    ]);

    expect(fn () => app(IndicatorAccessDelivery::class)->sendFreeRequestAccess($accessRequest))
        ->toThrow(RuntimeException::class, 'Email delivery is not configured');

    expect($accessRequest->fresh()->status)->toBe('new');
});

test('admin smtp settings are encrypted and applied to the mail configuration', function () {
    SmtpMailSettings::create([
        'host' => 'smtp.example.test',
        'port' => 587,
        'scheme' => 'smtp',
        'username' => 'smtp-user',
        'password' => 'smtp-secret',
        'from_address' => 'mail@example.test',
        'from_name' => 'Genesis Block',
    ]);
    config(['mail.default' => 'log']);

    expect(app(MailTransportConfiguration::class)->applySavedSettings())->toBeTrue()
        ->and(config('mail.default'))->toBe('smtp')
        ->and(config('mail.mailers.smtp.host'))->toBe('smtp.example.test')
        ->and(config('mail.mailers.smtp.password'))->toBe('smtp-secret')
        ->and(SmtpMailSettings::query()->first()->password)->toBe('smtp-secret')
        ->and(DB::table('smtp_mail_settings')->value('password'))->not->toBe('smtp-secret');
});
