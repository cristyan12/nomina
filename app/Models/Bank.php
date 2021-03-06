<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

	protected $guarded = [];

    public function profiles()
    {
    	return $this->hasMany(EmployeeProfile::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
