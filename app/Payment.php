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

    public function sales_order()
    {
        return $this->belongsTo(Client::class, 'id');
    }
}
