<?php

use App\Models\GoogleOAuthSettings;
use App\Models\User;
use Laravel\Fortify\Features;
use Laravel\Socialite\Facades\Socialite;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('login screen can be rendered', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200)
        ->assertSee('Continue with Google');
});

test('verified google users can sign in and receive only the customer role', function () {
    GoogleOAuthSettings::create([
        'client_id' => 'google-client-id',
        'client_secret' => 'google-client-secret',
    ]);
    $googleUser = \Laravel\Socialite\Two\User::fake([
        'id' => 'google-customer-123',
        'name' => 'Google Customer',
        'email' => 'google-customer@example.test',
    ]);
    $googleUser->setRaw(array_merge($googleUser->getRaw(), ['verified_email' => true]));
    $provider = Mockery::mock();
    $provider->shouldReceive('user')->once()->andReturn($googleUser);
    Socialite::shouldReceive('forgetDrivers')->once();
    Socialite::shouldReceive('driver')->once()->with('google')->andReturn($provider);

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('account', absolute: false));

    $user = User::query()->where('email', 'google-customer@example.test')->sole();
    $this->assertAuthenticatedAs($user);
    expect($user->google_id)->toBe('google-customer-123')
        ->and($user->hasRole('customer'))->toBeTrue()
        ->and($user->hasRole('admin'))->toBeFalse();
});

test('google sign in rejects an email that google has not verified', function () {
    GoogleOAuthSettings::create([
        'client_id' => 'google-client-id',
        'client_secret' => 'google-client-secret',
    ]);
    $googleUser = \Laravel\Socialite\Two\User::fake([
        'id' => 'google-unverified-123',
        'email' => 'unverified@example.test',
    ]);
    $provider = Mockery::mock();
    $provider->shouldReceive('user')->once()->andReturn($googleUser);
    Socialite::shouldReceive('forgetDrivers')->once();
    Socialite::shouldReceive('driver')->once()->with('google')->andReturn($provider);

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('google');

    $this->assertGuest();
    expect(User::query()->count())->toBe(0);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->withoutTwoFactor()->create();

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrorsIn('email');

    $this->assertGuest();
});

test('users with two factor enabled are redirected to two factor challenge', function () {
    if (! Features::canManageTwoFactorAuthentication()) {
        $this->markTestSkipped('Two-factor authentication is not enabled.');
    }
    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);

    $user = User::factory()->create();

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('two-factor.login'));
    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('home'));
    $this->assertGuest();
});
