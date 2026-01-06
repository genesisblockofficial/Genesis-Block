<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'description',
        'deleted_at',
    ];
}
