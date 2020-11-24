<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadFamiliar extends Model
{
    protected $table = 'load_familiars';

    protected $guarded = [];

    protected $casts = [
        'born_at' => 'date',
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

    public function getBornAt()
    {
        if ($this->born_at == null) {
            return '';
        }

        return $this->born_at->format('Y-m-d');
    }

    public function url()
    {
        return url("employees/{$this->employee_id}/familiars/{$this->id}");
    }
}
