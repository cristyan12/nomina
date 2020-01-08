<?php

namespace App;

trait CalculatePay
{
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
     * @param  int $hours
     * @param  string $journal
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
     *
     * @param  int $days
     */
    public function paySixthDayWorked($days)
    {
        $result = $this->position->basic_salary * $days;

        return number_format($result, 2, ',', '.');
    }

     /** Pago de Bonificación por Tiempo de Viaje nocturno.
       *
       * @param int $hours
      */
    public function payTravelTimeNightly($hours): string
    {
        $hourlySalary = $this->position->getSalaryByHours(
            $this->getDefaultHoursByJournal()
        );

        $result = $hourlySalary * 0.38 * $hours;

        return number_format($result, 2, ',', '.');
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
     * Obtiene las cantidades para calcular el Bono Nocturno.
     *
     * @param mixed     $workedDaysMixed          Dias trabajados mixtos
     * @param mixed     $sixthDayWorkedMixed      Sexto dia trabajado mixto
     * @param mixed     $workedDaysNigthly        Dias trabajados nocturnos
     * @param mixed     $sixthDayWorkedNigthly    Sexto dia trabajado nocturno
     *
     * @return int
     */
    public function getQuantityBonusNight($workedDaysMixed, $sixthDayWorkedMixed, $workedDaysNigthly, $sixthDayWorkedNigthly): int
    {
        $a = ($workedDaysMixed + $sixthDayWorkedMixed) * 4;

        $b = ($workedDaysNigthly + $sixthDayWorkedNigthly) * 6;

        return $a + $b;
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