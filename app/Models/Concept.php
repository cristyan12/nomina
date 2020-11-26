<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'quantity', 'calculation_salary', 'formula'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
