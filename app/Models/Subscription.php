<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $primaryKey = 'subscription_id';

    protected $fillable = [
        'plan_type',
        'price',
        'description',
        'features'
    ];
}
