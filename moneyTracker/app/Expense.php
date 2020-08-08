<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
        'spending_category_id',
        'amount',
        'wallet_id',
        'user_id',
    ];
}
