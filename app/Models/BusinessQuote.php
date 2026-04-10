<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessQuote extends Model
{
    protected $table = 'business_quotes';

    protected $fillable = [
        'businessName',
        'contactPerson',
        'businessEmail',
        'businessPhone',
        'businessType',
        'pickupNeeded',
        'volume',
        'quoteMessage',
    ];

    protected $casts = [
        'pickupNeeded' => 'boolean',
    ];
}

