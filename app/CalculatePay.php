<?php

namespace App;

trait CalculatePay
{
    /**
     * Horas para calcular el bono por el Tiempo de Viaje en jornada nocturna.
     *
     * @var $hoursForTravelTimeNigthly
     */
    protected $hoursForTravelTimeNigthly;

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

    // SB, Dias trabajados diurnos*, Dias trabajados mixtos*, Dias trabajados nocturnos*,
    // Tiempo de Viaje Diurno 52% METODO*, Tiempo de Viaje Diurno 77% METODO*,
    // Tiempo de Viaje Mixto 52% METODO*, Tiempo de Viaje Mixto 77% METODO*,
    // Tiempo de Viaje Nocturno 52% METODO*, Tiempo de Viaje Nocturno 77% METODO*,
    // Pago de comida, Bonif. Tiempo de viaje nocturno*, Sexto dia trabajado (Diurno, Mixto o Nocturno)*,
    // Ayuda de ciudad*, Prima Dominical a SB*, Prima por sexto dia trabajado a SB*, Bono Nocturno a SB*

    // Setters

    /**
     * Estable la cantidad de días trabajados en jornada mixta.
     *
     * @var $workedDaysMixed
     */
    public function setWorkedDaysMixed($workedDaysMixed)
    {
        $this->workedDaysMixed = $workedDaysMixed;

        return $this;
    }

    /**
     * Sexto día trabajado en jornada mixta.
     *
     * @var $sixthDayWorkedMixed
     */
    public function setSixthDayWorkedMixed($sixthDayWorkedMixed)
    {
        $this->sixthDayWorkedMixed = $sixthDayWorkedMixed;

        return $this;
    }

    /**
     * Establece la cantidad de días trabajados en jornada nocturna.
     *
     * @var $workedDaysNigthly
     */
    public function setWorkedDaysNigthly($workedDaysNigthly)
    {
        $this->workedDaysNigthly = $workedDaysNigthly;

        return $this;
    }

    /**
     * Sexto día trabajado en jornada nocturna.
     *
     * @var $sixthDayWorkedNigthly
     */
    public function setSixthDayWorkedNigthly($sixthDayWorkedNigthly)
    {
        $this->sixthDayWorkedNigthly = $sixthDayWorkedNigthly;

        return $this;
    }
    public function setHoursForTravelTimeNigthly($hours)
    {
        $this->hoursForTravelTimeNigthly = $hours;

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
    public function payWorkedDays($days): string
    {
        $result = $this->position->basic_salary * $days;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el pago de las horas extras trabajadas por un empleado dado
     *
     * @param int $hours
     * @param string $typeJournal
     */
    public function payExtraHours($hours, $journal = null): string
    {
        $salaryByHour = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal($journal)
        );

        $result = $salaryByHour * $hours * $this->getPercentFor($journal);

        return number_format($result, 2, ',', '.');
    }

    /**
     * Pago por el Tiempo de Viaje
     *
     * @param  int      $hours
     * @param  string   $journal
     * @param  string   $journalForTravelTime
     */
    public function payTravelTime($hours, $journal, $journalForTravelTime = null): string
    {
        $salaryByHour = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal($journal)
        );

        $result = $salaryByHour * $this->getPercentForTravelTime($journalForTravelTime) * $hours;

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
    public function getNightBonusPaySB($quantitiesBonusNight = [], $bonusNightExtraHoursDays, $bonusNightExtraHoursMixed)
    {
        $salaryHour = $this->position->getSalaryByHours(8) * 0.38;

        $qBonusNight = $this->setWorkedDaysMixed($quantitiesBonusNight[0])
            ->setSixthDayWorkedMixed($quantitiesBonusNight[1])
            ->setWorkedDaysNigthly($quantitiesBonusNight[2])
            ->setSixthDayWorkedNigthly($quantitiesBonusNight[3])
            ->getQuantityBonusNight();

        $result = $salaryHour * ($qBonusNight + $bonusNightExtraHoursDays + $bonusNightExtraHoursMixed);

        return number_format($result, 2, ',', '.');
    }

     /** Bonificación por Tiempo de Viaje nocturno.
       *
       * @param int $hours
      */
    public function bonusTravelTimeNightly(): string
    {
        $hourlySalary = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal()
        );

        $result = $hourlySalary * 0.38 * $this->hoursForTravelTimeNigthly;

        return number_format($result, 2, ',', '.');
    }

    /**
     * Obtiene el Salario Normal Diario (PEG 0001)
     */
    public function getNormalSalaryPEG_0001()
    {
        // Leyenda:
        // D = Diurno
        // M = Mixto
        // N = Nocturno

        // Conceptos que lo integran:

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
            'diaria52' => 1.52,
            'diaria77' => 1.77,
            'mixta52' => 1.52,
            'mixta77' => 1.77,
            'nocturna52' => 1.52,
            'nocturna77' => 1.77,
            'maracaibo83' => 1.83,
        ];

        return $percents[$typeJournal];
    }
}