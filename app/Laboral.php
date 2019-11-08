<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboral extends Model
{
    public function profile()
    {
        return $this->belongsTo(EmployeeProfile::class);
    }

    public function setExtraHoursByWeek($hours)
    {
        $this->extra_hours_by_week = $hours;
    }
}
