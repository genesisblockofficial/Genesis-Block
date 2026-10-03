<?php

namespace App\Services;

use App\Models\GoogleOAuthSettings;
use Laravel\Socialite\Facades\Socialite;

class GoogleOAuthConfiguration
{
    public function applySavedCredentials(): bool
    {
        $settings = GoogleOAuthSettings::query()->first();

        if (! $settings || ! filled($settings->client_id) || ! filled($settings->client_secret)) {
            config([
                'services.google.client_id' => null,
                'services.google.client_secret' => null,
            ]);

            Socialite::forgetDrivers();

            return false;
        }

        config([
            'services.google.client_id' => $settings->client_id,
            'services.google.client_secret' => $settings->client_secret,
            'services.google.redirect' => route('auth.google.callback'),
        ]);

        Socialite::forgetDrivers();

        return true;
    }
}
