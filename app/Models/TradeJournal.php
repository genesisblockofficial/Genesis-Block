<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeJournal extends Model
{
    protected $fillable = [
        'user_id',
        'trade_date',
        'symbol',
        'direction',
        'setup',
        'entry_price',
        'stop_loss',
        'target_price',
        'result',
        'pnl',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'trade_date' => 'date',
            'entry_price' => 'decimal:5',
            'stop_loss' => 'decimal:5',
            'target_price' => 'decimal:5',
            'pnl' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
