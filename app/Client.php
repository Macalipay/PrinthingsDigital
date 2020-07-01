<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'contact',
        'company',
        'company_address',
        'client_type',
        'market_source'
    ];

    public function sales()
    {
        return $this->hasOne(SalesOrder::class);
    }

    public function PaymentName()
    {
        return $this->hasOneThrough(
            Payment::class,
            SalesOrder::class,
            'client_id', // Foreign key on cars table...
            'sales_order_id', // Foreign key on owners table...
            'id', // Local key on mechanics table...
            'id' // Local key on cars table...
        );
    }
}
