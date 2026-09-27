<?php

use App\Models\StripeSettings;
use App\Services\StripeCredentials;
use App\Models\User;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('stripe secret keys are encrypted at rest and follow the active admin environment', function () {
    $settings = StripeSettings::create([
        'active_environment' => 'test',
        'test_publishable_key' => 'pk_test_public',
        'test_secret_key' => 'sk_test_private_value',
        'test_webhook_secret' => 'whsec_test_private_value',
        'live_publishable_key' => 'pk_live_public',
        'live_secret_key' => 'sk_live_private_value',
        'live_webhook_secret' => 'whsec_live_private_value',
    ]);

    expect($settings->getRawOriginal('test_secret_key'))->not->toBe('sk_test_private_value')
        ->and($settings->getRawOriginal('test_webhook_secret'))->not->toBe('whsec_test_private_value');

    $credentials = app(StripeCredentials::class);

    expect($credentials->active()['environment'])->toBe('test')
        ->and($credentials->active()['secret'])->toBe('sk_test_private_value')
        ->and($credentials->webhookSecrets())->toBe([
            'test' => 'whsec_test_private_value',
            'live' => 'whsec_live_private_value',
        ]);

    $settings->update(['active_environment' => 'live']);

    expect($credentials->active()['environment'])->toBe('live')
        ->and($credentials->active()['secret'])->toBe('sk_live_private_value');
});

test('admin stripe settings page never renders saved secret values', function () {
    $settings = StripeSettings::create([
        'active_environment' => 'test',
        'test_publishable_key' => 'pk_test_visible',
        'test_secret_key' => 'sk_test_do_not_render',
        'test_webhook_secret' => 'whsec_do_not_render',
    ]);

    $admin = User::create([
        'first_name' => 'Payment',
        'last_name' => 'Admin',
        'email' => 'stripe-admin@example.test',
        'password' => 'password',
    ]);

    $this->withoutMiddleware(Authenticate::class)
        ->actingAs($admin)
        ->get(route('filament.admin.pages.stripe-settings', [], false))
        ->assertOk()
        ->assertSee('Saved; enter only to rotate')
        ->assertDontSee('sk_test_do_not_render')
        ->assertDontSee('whsec_do_not_render');
});
