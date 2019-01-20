<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function position()
    {
    	return $this->hasOne(Position::class);
    }
}
