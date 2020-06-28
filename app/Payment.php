<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_date',
        'sales_order_id',
        'amount_paid',
        'type',
    ];
}
