<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'customer_support_title',
        'customer_support_description',
        'customer_support_email',
        'customer_support_phone',
        'customer_support_hours',
        'sales_partnerships_title',
        'sales_partnerships_description',
        'sales_partnerships_email',
        'sales_partnerships_phone',
        'sales_partnerships_hours',
        'education_training_title',
        'education_training_description',
        'education_training_email',
        'education_training_phone',
        'education_training_hours',
        'company_name',
        'address',
        'website',
        'email',
        'phone',
    ];
}
