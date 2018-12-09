<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabulator extends Model
{
    protected $fillable = [
        'code', 'name', 'basic_salary'
    ];
}
