<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndicatorAccessMailSettings extends Model
{
    protected $fillable = [
        'subject',
        'body',
    ];
}
