<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table = 'nominas';

    protected $fillable = [
        'name', 'type', 'periods', 
        'first_period_at', 'last_period_at'
    ];

    protected $casts = [
        'first_period_at' => 'date',
        'last_period_at' => 'date',
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
        if (! $this->first_period_at == '' ) {
            return $this->first_period_at->toDateString();
        }

        return 'N/D';
    }

    public function getLastDatePeriodAttribute()
    {
        if (! $this->last_period_at == '' ) {
            return $this->last_period_at->toDateString();
        }

        return 'N/D';
    }
}
