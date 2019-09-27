<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadFamiliar extends Model
{
    protected $table = 'load_familiars';

    protected $guarded = [];

    protected $casts = [
        'born_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullSexAttribute()
    {
        if ($this->sex == 'M') {
            return 'Masculino';
        }
        return 'Femenino';
    }
}
