<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class)->withDefault();
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function familiars()
    {
        return $this->hasMany(LoadFamiliar::class);
    }

    public function nominas()
    {
        return $this->hasMany(Nomina::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
