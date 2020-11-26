<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'rif', 'address',
        'phone_number', 'email', 'city',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
