<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaSettings extends Model
{
    protected $fillable = [
        'youtube_url',
        'telegram_url',
        'whatsapp_url',
        'instagram_url',
        'facebook_url',
        'x_url',
    ];
}
