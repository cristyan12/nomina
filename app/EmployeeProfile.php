<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $guarded = [];

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }

    public function position()
    {
    	return $this->belongsTo(Position::class);
    }
}
