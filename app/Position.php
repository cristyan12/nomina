<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'code', 'name', 'basic_salary'
    ];

    public function employees()
    {
    	return $this->hasMany(Employee::class);
    }
    
    public function getFormatSalaryAttribute()
    {
        return number_format($this->basic_salary, 2, ',', '.');
    }
}
