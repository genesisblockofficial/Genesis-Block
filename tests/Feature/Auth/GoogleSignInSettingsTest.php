<?php

use App\Models\GoogleOAuthSettings;
use App\Models\User;
use App\Services\GoogleOAuthConfiguration;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;

uses(RefreshDatabase::class);

test('google oauth secrets are encrypted and never rendered by the admin settings page', function () {
    $settings = GoogleOAuthSettings::create([
        'client_id' => 'google-client-id.apps.googleusercontent.com',
        'client_secret' => 'google-secret-do-not-render',
    ]);
    $admin = User::create([
        'first_name' => 'Google',
        'last_name' => 'Admin',
        'email' => 'google-admin@example.test',
        'password' => 'password',
    ]);

    expect($settings->getRawOriginal('client_secret'))->not->toBe('google-secret-do-not-render');

    $this->withoutMiddleware(Authenticate::class)
        ->actingAs($admin)
        ->get(route('filament.admin.pages.google-sign-in-settings', [], false))
        ->assertOk()
        ->assertSee('Saved; enter only to change')
        ->assertSee('http://localhost/auth/google/callback')
        ->assertDontSee('google-secret-do-not-render');
});

test('saved google credentials use the current request host for oauth callback', function () {
    GoogleOAuthSettings::create([
        'client_id' => 'google-client-id.apps.googleusercontent.com',
        'client_secret' => 'google-client-secret',
    ]);
    config(['services.google.redirect' => 'http://stale-host.example/auth/google/callback']);
    Socialite::shouldReceive('forgetDrivers')->once();

    expect(app(GoogleOAuthConfiguration::class)->applySavedCredentials())->toBeTrue()
        ->and(config('services.google.redirect'))->toBe(route('auth.google.callback'));
});
