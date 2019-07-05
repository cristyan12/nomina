<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table = 'nominas';

    protected $fillable = [
        'name', 'type', 'periods', 'first_period'
    ];

    protected $casts = [
        'first_period' => 'date'
    ];

    public function getNumbersPeriodsAttribute()
    {
        if (! $this->periods == '' ) {
            return $this->periods . ' períodos';
        }

        return 'N/D';
    }

    public function getFirstDatePeriodAttribute()
    {
        if (! $this->first_period == '' ) {
            return $this->first_period->toDateString();
        }

        return 'N/D';
    }
}
