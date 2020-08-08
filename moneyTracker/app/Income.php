<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //
    protected $fillable = [
        'income_source_id',
        'amount',
        'wallet_id',
        'user_id',
    ];
}
