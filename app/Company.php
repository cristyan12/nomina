<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'name', 'rif', 'address',
        'phone_number', 'email', 'city',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function getLimitAddressAttribute(): string
    {
        return Str::limit($this->address, 50);
    }
}
