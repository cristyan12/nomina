<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $guarded = [];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function employees()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
    	return $this->belongsTo(Position::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getContractTypeAttribute()
    {
        if ($this->contract == 'I') {
            return 'Indefinido';
        }
        return 'Temporal';
    }

    public function payByExtraHoursDay($hours, $percent = null)
    {
        $percent = 93;

        $salaryByHour = $this->position->getHoursBySalary();
        
        $result = number_format(
            $salaryByHour * $hours * ($percent / 100), 2, 
            ',', 
            '.'
        );

        return $result;
    }
}
