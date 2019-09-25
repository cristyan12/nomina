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
}
