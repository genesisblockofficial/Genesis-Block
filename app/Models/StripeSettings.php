<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StripeSettings extends Model
{
    protected $fillable = [
        'active_environment',
        'test_publishable_key',
        'test_secret_key',
        'test_webhook_secret',
        'live_publishable_key',
        'live_secret_key',
        'live_webhook_secret',
    ];

    protected function casts(): array
    {
        return [
            'test_secret_key' => 'encrypted',
            'test_webhook_secret' => 'encrypted',
            'live_secret_key' => 'encrypted',
            'live_webhook_secret' => 'encrypted',
        ];
    }
}
