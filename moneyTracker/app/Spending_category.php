<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending_category extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id',
    ];
}
