<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndicatorAccessRequest extends Model
{
    protected $fillable = [
        'user_id',
        'indicator_id',
        'indicator_name',
        'name',
        'email',
        'message',
        'status',
        'notified_at',
    ];

    protected function casts(): array
    {
        return [
            'notified_at' => 'datetime',
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
