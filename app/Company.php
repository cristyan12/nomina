<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'rif', 'address', 'phone_number', 'email', 'city'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
