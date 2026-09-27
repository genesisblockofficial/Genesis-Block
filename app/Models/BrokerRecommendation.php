<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrokerRecommendation extends Model
{
    protected $fillable = [
        'name',
        'market',
        'website_url',
        'logo',
        'description',
        'action_note',
        'contact_email',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
