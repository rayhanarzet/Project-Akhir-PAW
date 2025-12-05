<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'quantity',
        'total_price',
        'payment_status',
    ];
}
