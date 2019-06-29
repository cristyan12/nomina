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

    public function getFirstDatePeriodsAttribute()
    {
        if (! $this->first_period == '' ) {
            return $this->first_period->format('d-m-Y');
        }

        return 'N/D';
    }
}
