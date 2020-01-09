<?php

namespace App;

use App\CalculatePay;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use CalculatePay;

    protected $guarded = [];

    /**
     * Dias trabajados mixtos
     *
     * @var $workedDaysMixed
     */
    private $workedDaysMixed;

    /**
     * Sexto dia trabajado mixto
     *
     * @var $sixthDayWorkedMixed
     */
    private $sixthDayWorkedMixed;

    /**
     * Dias trabajados nocturnos
     *
     * @var $workedDaysNigthly
     */
    private $workedDaysNigthly;

    /**
     * Sexto dia trabajado nocturno
     *
     * @var $sixthDayWorkedNigthly
     */
    private $sixthDayWorkedNigthly;

    public function setWorkedDaysMixed($workedDaysMixed)
    {
        $this->workedDaysMixed = $workedDaysMixed;

        return $this;
    }

    public function setSixthDayWorkedMixed($sixthDayWorkedMixed)
    {
        $this->sixthDayWorkedMixed = $sixthDayWorkedMixed;

        return $this;
    }

    public function setWorkedDaysNigthly($workedDaysNigthly)
    {
        $this->workedDaysNigthly = $workedDaysNigthly;

        return $this;
    }

    public function setSixthDayWorkedNigthly($sixthDayWorkedNigthly)
    {
        $this->sixthDayWorkedNigthly = $sixthDayWorkedNigthly;

        return $this;
    }

    /**
     * Obtiene las cantidades para calcular el Bono Nocturno.
     *
     * @return int
     */
    public function getQuantityBonusNight(): int
    {
        $a = ($this->workedDaysMixed + $this->sixthDayWorkedMixed) * 4;

        $b = ($this->workedDaysNigthly + $this->sixthDayWorkedNigthly) * 6;

        return $a + $b;
    }

    // Relations

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function employees()
    {
    	return $this->belongsTo(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
    	return $this->belongsTo(Position::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getContractTypeAttribute()
    {
        if ($this->contract == 'I') {
            return 'Indefinido';
        }
        return 'Temporal';
    }
}
