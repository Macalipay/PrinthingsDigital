<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'code',
        'order_date',
        'client_id',
        'category_id',
        'details',
        'quantity',
        'unit_price',
        'balance',
        'due_date',
    ];

    public function sales()
    {
        return $this->hasOne(Client::class);
    }
}
