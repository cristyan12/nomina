<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $guarded = [];

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

    /**
     * Obtiene el pago de las horas extras trabajadas por un empleado dado
     *
     * @param int $hours
     * @param string $typeJournal
     * @return string
     */
    public function payExtraHours($hours, $journal = null)
    {
        $percent = $this->getPercentFor($journal);

        $salaryByHour = $this->position->getSalaryByHours($this->getDefaultHoursByJournal($journal));

        $result = number_format($salaryByHour * $hours * ($percent / 100), 2, ',', '.');

        return $result;
    }

    /**
     * Obtiene las horas por defecto de los tipos de jornada.
     *
     * @param string $typeJournal
     * @return array
     */
    protected function getDefaultHoursByJournal($typeJournal)
    {
        $journals = [
            'diaria' => 8,
            'mixta' => 7.5,
            'nocturna' => 7,
        ];

        return $journals[$typeJournal] ?? 8;
    }

    /**
     * Obtiene los procentajes por defecto de los tipos de jornada.
     *
     * @param string $typeJournal
     * @return array
     */
    protected function getPercentFor($typeJournal)
    {
        $percents = [
            'diaria' => 93,
            'mixta' => 81,
            'nocturna' => 81,
        ];

        return $percents[$typeJournal] ?? 93;
    }
}
