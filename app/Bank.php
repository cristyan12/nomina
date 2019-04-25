<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	protected $guarded = [];
	
    public function profiles()
    {
    	return $this->hasMany(EmployeeProfile::class);
    }
}
