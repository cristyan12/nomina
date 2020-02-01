<?php

namespace App;

trait CalculatePay
{
    /**
     * Horas extras
     *
     * @var $extraHours
     */
    protected $extraHours;

    /**
     * Dias trabajados mixtos
     *
     * @var $workedDaysMixed
     */
    protected $workedDaysMixed;

    /**
     * Sexto dia trabajado mixto
     *
     * @var $sixthDayWorkedMixed
     */
    protected $sixthDayWorkedMixed;

    /**
     * Dias trabajados nocturnos
     *
     * @var $workedDaysNigthly
     */
    protected $workedDaysNigthly;

    /**
     * Sexto dia trabajado nocturno
     *
     * @var $sixthDayWorkedNigthly
     */
    protected $sixthDayWorkedNigthly;

    /**
     * Días trabajados en jornada diurna.
     *
     * @var $workedDaysDaily
     */
    protected $workedDaysDaily;

    /**
     * Horas para el cálculo del Bono de Tiempo de Viaje Nocturno
     *
     * @var $bonusHoursOfNightTravelTime
     */
    protected $bonusHoursOfNightTravelTime;

    /**
     * Horas del Tiempo de Viaje
     *
     * @var $travelTimeHours
     */
    protected $travelTimeHours;

    /**
     * Establece las horas de Tiempo de Viaje
     *
     * @param $hours
    */
    public function setTravelTimeHours($hours)
    {
        $this->travelTimeHours = $hours;

        return $this;
    }

    /**
     * Establece las horas extras
     *
     * @param $hours
    */
    public function setExtraHours($hours)
    {
        $this->extraHours = $hours;

        return $this;
    }

    /**
     * Establece los días en que se trabajó en jornada diurna
     *
     * @param $days
    */
    public function setWorkedDaysDaily($days)
    {
        $this->workedDaysDaily = $days;

        return $this;
    }

    /**
     * Estable la cantidad de días trabajados en jornada mixta.
     *
     * @param $workedDaysMixed
     */
    public function setWorkedDaysMixed($workedDaysMixed)
    {
        $this->workedDaysMixed = $workedDaysMixed;

        return $this;
    }

    /**
     * Sexto día trabajado en jornada mixta.
     *
     * @param $sixthDayWorkedMixed
     */
    public function setSixthDayWorkedMixed($sixthDayWorkedMixed)
    {
        $this->sixthDayWorkedMixed = $sixthDayWorkedMixed;

        return $this;
    }

    /**
     * Establece la cantidad de días trabajados en jornada nocturna.
     *
     * @param $workedDaysNigthly
     */
    public function setWorkedDaysNigthly($workedDaysNigthly)
    {
        $this->workedDaysNigthly = $workedDaysNigthly;

        return $this;
    }

    /**
     * Sexto día trabajado en jornada nocturna.
     *
     * @param $sixthDayWorkedNigthly
     */
    public function setSixthDayWorkedNigthly($sixthDayWorkedNigthly)
    {
        $this->sixthDayWorkedNigthly = $sixthDayWorkedNigthly;

        return $this;
    }

    /**
     * Bono de Tiempo de Viaje Nocturno
     *
     * @param float $hours
     */
    public function setBonusHoursOfNightTravelTime($hours)
    {
        $this->bonusHoursOfNightTravelTime = $hours;

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

    /**
     * Obtiene el pago el pago por los dias trabajados con SB
     *
     * @param  int $days
     */
    public function payWorkedDays(): string
    {
        $result = $this->getDiarySalary() * $this->workedDaysDaily;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el pago de las horas extras trabajadas por un empleado dado
     *
     * @param int $hours
     * @param string $typeJournal
     */
    public function payExtraHours($journal = null): string
    {
        $salaryByHour = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal($journal)
        );

        $result = $salaryByHour * $this->extraHours * $this->getPercentFor($journal);

        return number_format($result, 2, ',', '.');
    }

    /**
     * Pago por el Tiempo de Viaje
     *
     * @param  int      $hours
     * @param  string   $journal
     * @param  string   $journalForTravelTime
     */
    public function payTravelTime($journal, $journalForTravelTime = null): string
    {
        $salaryByHour = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal($journal)
        );

        $result = $salaryByHour * $this->getPercentForTravelTime($journalForTravelTime) * $this->travelTimeHours;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el pago el pago por el sexto dia trabajado SB
     */
    public function paySixthDayWorked(): string
    {
        return number_format($this->getDiarySalary(), 2, ',', '.');
    }

     /**
     * Pago de La Ayuda Única y Especial de Ciudad.
     */
    public function payCityHelp(): string
    {
        $result = $this->getMonthlySalary() * 0.05;

        return number_format($result, 2, ',', '.');
    }

     /**
     * Bono por sexto día trabajado
     */
    public function bonusPerSixDayWorked(): string
    {
        $result = $this->getDiarySalary() * 1.5;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Bono por trabajo en día domingo
     */
    public function bonusPerSunday(): string
    {
        $result = $this->getDiarySalary() * 1.5;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Pago del Bono Nocturno a Salario Base
     *
     * @param   array   $quantitiesBonusNight
     * @param   mixed   $bonusNightExtraHoursDays
     * @param   mixed   $bonusNightExtraHoursMixed
     *
     * @return  string
     */
    public function getNightBonusPaySB(
        $quantitiesBonusNight = [], $bonusNightExtraHoursDays, $bonusNightExtraHoursMixed
    )
    {
        $salaryHour = $this->position->getSalaryByHours(8) * 0.38;

        $qBonusNight = $this
            ->setWorkedDaysMixed($quantitiesBonusNight[0])
            ->setSixthDayWorkedMixed($quantitiesBonusNight[1])
            ->setWorkedDaysNigthly($quantitiesBonusNight[2])
            ->setSixthDayWorkedNigthly($quantitiesBonusNight[3])
            ->getQuantityBonusNight();

        $result = $salaryHour * ($qBonusNight + $bonusNightExtraHoursDays + $bonusNightExtraHoursMixed);

        return number_format($result, 2, ',', '.');
    }

     /**
      * Bonificación por Tiempo de Viaje nocturno.
      */
    public function bonusTravelTimeNightly(): string
    {
        $hourlySalary = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal()
        );

        $result = $hourlySalary * 0.38 * $this->bonusHoursOfNightTravelTime;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el Salario Normal Diario (PEG 0001)
     */
    public function getNormalSalaryPEG_0001()
    {
        // SB, Dias trabajados diurnos, Dias trabajados mixtos, Dias trabajados nocturnos,
        // Tiempo de Viaje Diurno 52%, Tiempo de Viaje Diurno 77%,
        // Tiempo de Viaje Mixto 52%, Tiempo de Viaje Mixto 77%,
        // Tiempo de Viaje Nocturno 52%, Tiempo de Viaje Nocturno 77%,
        // Pago de comida, Bonif. Tiempo de viaje nocturno, Sexto dia trabajado (Diurno, Mixto o Nocturno),
        // Ayuda de ciudad, Prima Dominical a SB, Prima por sexto dia trabajado a SB, Bono Nocturno a SB

        // se dividen entre las diferentes unidades de tiempo

        // Cantidad de dias trajados diurnos, mixtos y nocturnos, Sexto dia trabajado (D, M y N),
        // Permiso remunerado, Ausencia injustificada, Permiso no remunerado, Enfermedad ambulatoria,
        // Enfermedad profesional, Accidente industrial, Permiso sindical
    }

    /**
     * Obtiene el monto del salario base diario
     */
    public function getDiarySalary()
    {
        return $this->position->basic_salary;
    }

    /**
     * Obtiene el monto del pago mensual de su salario basico
     *
     * @param  int $days
     */
    public function getMonthlySalary()
    {
        return $this->position->basic_salary * 30;
    }

    /**
     * Obtiene las horas por defecto de los tipos de jornada.
     *
     * @param string $typeJournal
     */
    protected function getDefaultHoursByJournal($typeJournal = null)
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
     */
    protected function getPercentFor($typeJournal)
    {
        $percents = [
            'diaria' => 1.93,
            'mixta' => 1.81,
            'nocturna' => 1.81,
        ];

        return $percents[$typeJournal];
    }

    /**
     * Obtiene los procentajes por defecto para el cálculo del Tiempo de Viaje
     *
     * @param  string $typeJournal
     */
    protected function getPercentForTravelTime($typeJournal)
    {
        $percents = [
            'tvDiaria52' => 1.52,
            'tvDiaria77' => 1.77,
            'tvMixta52' => 1.52,
            'tvMixta77' => 1.77,
            'tvNocturna52' => 1.52,
            'tvNocturna77' => 1.77,
            'tvMaracaibo83' => 1.83,
        ];

        return $percents[$typeJournal];
    }
}