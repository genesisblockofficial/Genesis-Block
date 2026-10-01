<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndicatorPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'indicator_id',
        'indicator_name',
        'email',
        'amount_cents',
        'currency',
        'stripe_environment',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'status',
        'paid_at',
        'access_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'amount_cents' => 'integer',
            'paid_at' => 'datetime',
            'access_sent_at' => 'datetime',
        ];
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
