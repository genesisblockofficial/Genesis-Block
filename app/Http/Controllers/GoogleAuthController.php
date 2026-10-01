<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GoogleOAuthConfiguration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleAuthController extends Controller
{
    public function redirect(GoogleOAuthConfiguration $configuration): RedirectResponse
    {
        if (! $configuration->applySavedCredentials()) {
            return to_route('login')->withErrors([
                'google' => 'Google sign-in is not configured yet. Please sign in with your email and password.',
            ]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback(GoogleOAuthConfiguration $configuration): RedirectResponse
    {
        if (! $configuration->applySavedCredentials()) {
            return to_route('login')->withErrors([
                'google' => 'Google sign-in is not configured. Please sign in with your email and password.',
            ]);
        }

        $googleUser = Socialite::driver('google')->user();

        if (! ($googleUser->user['verified_email'] ?? false)) {
            return to_route('login')->withErrors([
                'google' => 'Google could not verify your email address. Please use another sign-in method.',
            ]);
        }

        $googleId = (string) $googleUser->getId();

        if ($googleId === '') {
            return to_route('login')->withErrors([
                'google' => 'Google did not provide a valid account identifier.',
            ]);
        }

        $user = User::query()->where('google_id', $googleId)->first();

        if (! $user) {
            $email = Str::lower((string) $googleUser->getEmail());

            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return to_route('login')->withErrors([
                    'google' => 'Google did not provide a valid email address.',
                ]);
            }

            $user = User::query()
                ->whereRaw('LOWER(email) = ?', [$email])
                ->first();
        }

        if ($user && filled($user->google_id) && $user->google_id !== $googleId) {
            return to_route('login')->withErrors([
                'google' => 'This account is linked to a different Google account.',
            ]);
        }

        if (! $user) {
            [$firstName, $lastName] = array_pad(explode(' ', trim((string) $googleUser->getName()), 2), 2, '');

            $user = User::create([
                'first_name' => $firstName ?: 'Google',
                'last_name' => $lastName ?: null,
                'name' => trim((string) $googleUser->getName()) ?: $firstName,
                'email' => $email,
                'password' => Hash::make(Str::random(64)),
                'email_verified_at' => now(),
            ]);

            $user->assignRole(Role::firstOrCreate(['name' => 'customer']));
        }

        $user->forceFill([
            'google_id' => $googleId,
            'email_verified_at' => $user->email_verified_at ?? now(),
        ])->save();

        Auth::login($user, remember: true);
        request()->session()->regenerate();

        return redirect()->intended(config('fortify.home', '/account'));
    }
}
