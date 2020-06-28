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

    public function client()
    {
        return $this->belongsTo(SalesOrder::class, 'client_id');
    }
}
