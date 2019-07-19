<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'number', 'type', 'auth_sign_1', 'auth_sign_2', 'company_id',
    ];
}
