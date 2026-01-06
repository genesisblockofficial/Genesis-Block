<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'main_heading',
        'sub_heading',
        '_is_start_trading',
        '_is_view_our_mission',
        'experience_year',
        'traders_count',
        'countries_count',
        'traders_volumn',
        'mission',
        'vission',
        'core_value_title_1',
        'core_value_description_1',
        'core_value_title_2',
        'core_value_description_2',
        'core_value_title_3',
        'core_value_description_3',
        'core_value_title_4',
        'core_value_description_4',
    ];
}
