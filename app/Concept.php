<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $fillable = [
        'name', 'description', 'quantity', 'calculation_salary', 'formula'
    ];
}
