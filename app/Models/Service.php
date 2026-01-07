<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active',
    ];

    public function serviceDetails()
    {
        return $this->hasOne(ServiceDetail::class);
    }
}
