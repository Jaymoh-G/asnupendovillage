<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'currency',
        'payment_method',
        'status',
        'transaction_reference',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
