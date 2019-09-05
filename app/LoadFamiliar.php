<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadFamiliar extends Model
{
    protected $fillable = ['employee_id', 'name', 'relationship', 'document', 'sex', 'born_at', 'instruction'];
}
