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

    // En la ocasión de establecer los firmantes
    // autorizados en las cuentas bancarias de la empresa
    public function accounts()
    {
        return $this->hasMany(Account::class, 'auth_1');
    }

    public function accounts2()
    {
        return $this->hasMany(Account::class, 'auth_2');
    }

    public function familiars()
    {
        return $this->hasMany(LoadFamiliar::class);
    }

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
        $interval = now()->diff($this->hired_at);

        return $interval->format('%y años, %m meses, y %d días');
    }
}
