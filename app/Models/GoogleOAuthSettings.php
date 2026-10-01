<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleOAuthSettings extends Model
{
    protected $table = 'google_oauth_settings';

    protected $fillable = [
        'client_id',
        'client_secret',
    ];

    protected function casts(): array
    {
        return [
            'client_secret' => 'encrypted',
        ];
    }
}
