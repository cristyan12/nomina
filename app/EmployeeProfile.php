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
     * Obtiene el pago el pago por los dias trabajados
     *
     * @param  int $days
     * @param  string $typeJournal
     * @return string
     */
    public function payWorkedDays($days)
    {
        $result = $this->position->basic_salary * $days;

        return number_format($result, 2, ',', '.');
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
        $salaryByHour = $this->position->getSalaryByHours($this->getDefaultHoursByJournal($journal));

        $result = $salaryByHour * $hours * $this->getPercentFor($journal);

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el pago por el Tiempo de Viaje
     *
     * @param  int $hours
     * @param  string $journal
     * @return string
     */
    public function payTravelTime($hours, $journal, $journalForTravelTime = null)
    {
        $salaryByHour = $this->position->getSalaryByHours($this->getDefaultHoursByJournal($journal));

        $result = $salaryByHour * $this->getPercentForTravelTime($journalForTravelTime) * $hours;

        return number_format($result, 2, ',', '.');
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
            'diaria' => 1.93,
            'mixta' => 1.81,
            'nocturna' => 1.81,
        ];

        return $percents[$typeJournal] ?? 93;
    }

    /**
     * Obtiene los procentajes por defecto de los tipos de jornada.
     *
     * @param  string $typeJournal
     * @return array
     */
    protected function getPercentForTravelTime($typeJournal)
    {
        $percents = [
            'diaria52' => 1.52,
            'diaria77' => 1.77,
            'mixta52' => 1.52,
            'mixta77' => 1.77,
            'nocturna52' => 1.52,
            'nocturna77' => 1.77,
        ];

        return $percents[$typeJournal] ?? 1.52;
    }
}
