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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'sales_order_id');
    }

}
