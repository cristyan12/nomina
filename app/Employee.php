<?php

namespace App;

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
}
