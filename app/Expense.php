<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expense_date',
        'expense_id',
        'amount',
        'description',
        'payment_type'
    ];

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class, 'id');
    }

}
