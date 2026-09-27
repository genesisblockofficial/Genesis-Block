<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indicator extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'cover_image',
        'is_paid',
        'price_cents',
        'trading_view_url',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_paid' => 'boolean',
            'is_active' => 'boolean',
            'price_cents' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function tradeSetups(): HasMany
    {
        return $this->hasMany(TradeSetup::class);
    }

    public function accessRequests(): HasMany
    {
        return $this->hasMany(IndicatorAccessRequest::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(IndicatorPurchase::class);
    }
}
