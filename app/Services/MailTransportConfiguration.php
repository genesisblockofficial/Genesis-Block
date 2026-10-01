<?php

namespace App\Services;

use App\Models\SmtpMailSettings;
use Illuminate\Support\Facades\Mail;

class MailTransportConfiguration
{
    public function applySavedSettings(): bool
    {
        $settings = SmtpMailSettings::query()->first();

        if (! $settings) {
            return false;
        }

        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.scheme' => $settings->scheme,
            'mail.mailers.smtp.url' => null,
            'mail.mailers.smtp.host' => $settings->host,
            'mail.mailers.smtp.port' => $settings->port,
            'mail.mailers.smtp.username' => $settings->username,
            'mail.mailers.smtp.password' => $settings->password,
            'mail.from.address' => $settings->from_address,
            'mail.from.name' => $settings->from_name,
        ]);

        Mail::purge('smtp');

        return true;
    }
}
