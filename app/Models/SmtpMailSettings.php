<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpMailSettings extends Model
{
    protected $fillable = [
        'host',
        'port',
        'scheme',
        'username',
        'password',
        'from_address',
        'from_name',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'encrypted',
        ];
    }
}
