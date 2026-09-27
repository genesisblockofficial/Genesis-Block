<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeSetup extends Model
{
    protected $fillable = [
        'indicator_id',
        'title',
        'symbol',
        'market',
        'direction',
        'entry_zone',
        'stop_loss',
        'target_zone',
        'analysis',
        'chart_image',
        'published_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }
}
