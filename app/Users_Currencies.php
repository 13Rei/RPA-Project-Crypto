<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Currencies extends Model
{
    protected $fillable = [
        'user_id', 'currency_id'
    ];
}
