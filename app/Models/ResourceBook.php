<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceBook extends Model
{
    protected $fillable = [
        'title',
        'author',
        'amazon_url',
        'cover_image',
        'is_beginner',
        'for_experienced_traders',
        'is_self_help',
        'rating',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_beginner' => 'boolean',
            'for_experienced_traders' => 'boolean',
            'is_self_help' => 'boolean',
            'is_active' => 'boolean',
            'rating' => 'integer',
            'sort_order' => 'integer',
        ];
    }
}
