<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $casts = [
        'born_at' => 'date',
        'hired_at' => 'date',
    ];

    public function profile()
    {
    	return $this->hasOne(EmployeeProfile::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullDocumentAttribute()
    {
        return "{$this->nationality}-{$this->document}";
    }

    public function getFullNationalityAttribute()
    {
        if ($this->nationality == 'V') {
            return 'Venezolana';
        }
        return 'Extranjera';
    }

    public function getFullSexAttribute()
    {
        if ($this->sex == 'M') {
            return 'Masculino';
        }
        return 'Femenino';
    }

    /**
    * Calcula la diferncia entre las fechas de contratación
    * y la fecha actual en formato leíble para los humanos.
    * 
    * @return string 
    */
    public function diffAntiquity()
    {
        $hired = new \DateTime($this->hired_at);

        $interval = now()->diff($hired);

        return $interval->format('%y años, %m meses, y %d días');
    }
}
