<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income_source extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id',
    ];
}
