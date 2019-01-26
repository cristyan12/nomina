<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function position()
    {
    	return $this->belongsTo(Position::class);
    }

    public function profile()
    {
    	return $this->hasOne(EmployeeProfile::class);
    }
}
