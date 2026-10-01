<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicCalendarSettings extends Model
{
    protected $fillable = [
        'enabled',
        'api_key',
    ];

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
            'api_key' => 'encrypted',
        ];
    }
}
