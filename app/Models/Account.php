<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bank_id',
        'number',
        'auth_1',
        'auth_2'
    ];

    public function auth1()
    {
        return $this->belongsTo(Employee::class, 'auth_1')->withDefault();
    }

    public function auth2()
    {
        return $this->belongsTo(Employee::class, 'auth_2')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
