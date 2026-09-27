<?php

namespace App\Services;

use App\Models\StripeSettings;

class StripeCredentials
{
    public function active(): array
    {
        $settings = StripeSettings::query()->first();
        $environment = $settings?->active_environment ?: config('services.stripe.mode', 'test');

        return $this->forEnvironment($environment);
    }

    public function activeEnvironment(): string
    {
        return $this->active()['environment'];
    }

    public function forEnvironment(string $environment): array
    {
        $environment = $environment === 'live' ? 'live' : 'test';
        $settings = StripeSettings::query()->first();
        $prefix = $environment . '_';
        $legacyMode = config('services.stripe.mode', 'test');
        $useLegacy = !$settings && $legacyMode === $environment;

        return [
            'environment' => $environment,
            'publishable_key' => $settings?->{$prefix . 'publishable_key'} ?: ($useLegacy ? config('services.stripe.key') : null),
            'secret' => $settings?->{$prefix . 'secret_key'} ?: ($useLegacy ? config('services.stripe.secret') : null),
            'webhook_secret' => $settings?->{$prefix . 'webhook_secret'} ?: ($useLegacy ? config('services.stripe.webhook_secret') : null),
        ];
    }

    public function webhookSecrets(): array
    {
        $secrets = [];

        foreach (['test', 'live'] as $environment) {
            $credentials = $this->forEnvironment($environment);

            if ($credentials['webhook_secret']) {
                $secrets[$environment] = $credentials['webhook_secret'];
            }
        }

        return $secrets;
    }
}
