<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'code', 'name', 'basic_salary'
    ];

    public function profile()
    {
    	return $this->hasMany(EmployeeProfile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatSalaryAttribute()
    {
        return $this->numericFormat($this->basic_salary);
    }

    // Salario base por hora en jornada de 8 horas diarias
    public function getSalaryByHours($workingHours)
    {
        return round($this->basic_salary / $workingHours, 2);
    }

    public function getNominaQuincenalAttribute()
    {
        return $this->numericFormat($this->basic_salary * 15);
    }

    protected function numericFormat($field)
    {
        return number_format($field, 2, ',', '.');
    }
}
