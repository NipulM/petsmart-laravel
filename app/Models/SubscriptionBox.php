<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionBox extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'subscription_box_id';

    protected $fillable = [
        'user_id',
        'subscription_id',
        'total_amount',
        'order_items',
        'start_date',
        'expiry_date',
        'customer_name',
    ];

    protected $casts = [
        'order_items' => 'array',
        'start_date' => 'datetime',
        'expiry_date' => 'datetime',
    ];
}
