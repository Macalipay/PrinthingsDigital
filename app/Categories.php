<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon'
    ];

    public function sales()
    {
        return $this->hasOne(SalesOrder::class);
    }
}
