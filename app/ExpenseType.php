<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function expense_name()
    {
        return $this->hasOne(Expense::class, 'expense_id');
    }
}
