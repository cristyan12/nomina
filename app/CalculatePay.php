<?php

namespace App;

trait CalculatePay
{
    protected $daysWorked;

    protected $dayWorkedDays;

    protected $mixedWorkedDays;

    protected $sixthDayWorkedDay;

    protected $sixthDayWorkedMixed;

    protected $nightWorkedDays;

    protected $sixthDayWorkedNigth;

    protected $hoursBonusNigthTravelTime = 0;

    protected $nightBonusDayOvertime = 0;

    protected $nightBonusMixedOvertime = 0;

    protected $hoursForNigthBonus = 0;

    protected $hoursDayTravelTime52;

    protected $hoursMixedTravelTime52;

    protected $hoursNigthTravelTime52;

    protected $hoursDayTravelTime77;

    protected $hoursMixedTravelTime77;

    protected $hoursNigthTravelTime77;

    /**
     * Permiso remunerado.
     *
     * @var
     */
    protected $paidPermit = 0;

    /**
     * Ausencia no justiicada.
     *
     * @var
     */
    protected $unexcusedAbsence = 0;

    /**
     * Permiso no remunerado.
     *
     * @var
     */
    protected $unpaidPermit = 0;

    /**
     * Enfermedad ambulatoria.
     *
     * @var
     */
    protected $outpatientDisease = 0;

    /**
     * Enfermedad profesional (Ocupacional).
     *
     * @var
     */
    protected $occupationalDisease = 0;

    /**
     * Accidente industrial.
     *
     * @var
     */
    protected $industrialAccident = 0;

    /**
     * Permiso sindical.
     *
     * @var
     */
    protected $unionPermit = 0;

    protected $methodsConcepts = [];

    protected $divisors = [];

    public function getMethodConcepts(): array
    {
        return [
            'daysWorkedDays' => $this->dayWorkedDays(),
            'mixedWorkedDays' => $this->mixedWorkedDays(),
            'nightWorkedDays' => $this->nightWorkedDays(),
            'dayTravelTime52' => $this->dayTravelTime52(),
            'dayTravelTime77' => $this->dayTravelTime77(),
            'mixedTravelTime52' => $this->mixedTravelTime52(),
            'mixedTravelTime77' => $this->mixedTravelTime77(),
            'nigthTravelTime52' => $this->nigthTravelTime52(),
            'nigthTravelTime77' => $this->nigthTravelTime77(),
            'bonusTravelTimeNight' => $this->bonusTravelTimeNight(),
            'sixthDayWorkedDay' => $this->sixthDayWorkedDay(),
            'sixthDayWorkedMixed' => $this->sixthDayWorkedMixed(),
            'sixthDayWorkedNigth' => $this->sixthDayWorkedNigth(),
            'sixthDayWorkedPremium' => $this->sixthDayWorkedPremium(),
            'sundayPremium' => $this->sundayPremium(),
            'nightBonus' => $this->nightBonus(),
            'mixedWatchExtraTime' => $this->mixedWatchExtraTime(),
            'nigthWatchExtraTime' => $this->nigthWatchExtraTime(),
        ];
    }

    public function getDivisors(): array
    {
        return [
            $this->dayWorkedDays,
            $this->mixedWorkedDays,
            $this->nightWorkedDays,
            $this->sixthDayWorkedDay,
            $this->sixthDayWorkedMixed,
            $this->sixthDayWorkedNigth,
            $this->paidPermit,
            $this->unexcusedAbsence,
            $this->unpaidPermit,
            $this->outpatientDisease,
            $this->occupationalDisease,
            $this->industrialAccident,
            $this->unionPermit
        ];
    }

    public function setDaysWorked(int $days): self
    {
        $this->daysWorked = $days;

        return $this;
    }

    public function setDayWorkedDays(int $days = 0): self
    {
        $this->dayWorkedDays = $days;

        return $this;
    }

    public function setSixthDayWorkedDay(int $day = 0): self
    {
        $this->sixthDayWorkedDay = $day;

        return $this;
    }

    public function setMixedWorkedDays(int $days = 0): self
    {
        $this->mixedWorkedDays = $days;

        return $this;
    }

    public function setSixthDayWorkedMixed(int $day = 0): self
    {
        $this->sixthDayWorkedMixed = $day;

        return $this;
    }

    public function setNightWorkedDays(int $days = 0): self
    {
        $this->nightWorkedDays = $days;

        return $this;
    }

    public function setSixthDayWorkedNigth(int $day = 0): self
    {
        $this->sixthDayWorkedNigth = $day;

        return $this;
    }

    public function setHoursDayTravelTime52(float $hours): self
    {
        $this->hoursDayTravelTime52 = $hours;

        return $this;
    }

    public function setHoursMixedTravelTime52(float $hours): self
    {
        $this->hoursMixedTravelTime52 = $hours;

        return $this;
    }

    public function setHoursNigthTravelTime52(float $hours): self
    {
        $this->hoursNigthTravelTime52 = $hours;

        return $this;
    }

    public function setHoursDayTravelTime77(float $hours): self
    {
        $this->hoursDayTravelTime77 = $hours;

        return $this;
    }

    public function setHoursMixedTravelTime77(float $hours): self
    {
        $this->hoursMixedTravelTime77 = $hours;

        return $this;
    }

    public function setHoursNigthTravelTime77(float $hours): self
    {
        $this->hoursNigthTravelTime77 = $hours;

        return $this;
    }

    public function hoursBonusTravelTimeNight(): self
    {
        $this->hoursBonusNigthTravelTime =
            (($this->dayWorkedDays + $this->sixthDayWorkedDay) * 0.5) +
            (($this->mixedWorkedDays + $this->sixthDayWorkedMixed) * 1.5) +
            (($this->nightWorkedDays + $this->sixthDayWorkedNigth) * 1.5);

        return $this;
    }

    public function bonusTravelTimeNight(): float
    {
        return $this->salaryHour() * 0.38 * $this->hoursBonusNigthTravelTime;
    }

    public function daysWorked(): float
    {
        return $this->basicSalary() * $this->daysWorked;
    }

    public function sixthDayWorked(): float
    {
        return $this->basicSalary() * 1;
    }

    public function dayTravelTime52(): float
    {
        return $this->salaryHour() * 1.52 * $this->hoursDayTravelTime52;
    }

    public function mixedTravelTime52(): float
    {
        return $this->salaryHour(7.5) * 1.52 * $this->hoursMixedTravelTime52;
    }

    public function nigthTravelTime52(): float
    {
        return $this->salaryHour(7) * 1.52 * $this->hoursNigthTravelTime52;
    }

    public function dayTravelTime77(): float
    {
        return $this->salaryHour() * 1.77 * $this->hoursDayTravelTime77;
    }

    public function mixedTravelTime77(): float
    {
        return $this->salaryHour(7.5) * 1.77 * $this->hoursMixedTravelTime77;
    }

    public function nigthTravelTime77(): float
    {
        return $this->salaryHour(7) * 1.77 * $this->hoursNigthTravelTime77;
    }

    public function dayWorkedDays(): float
    {
        return $this->dayWorkedDays * $this->basicSalary();
    }

    public function mixedWorkedDays(): float
    {
        return $this->mixedWorkedDays * $this->basicSalary();
    }

    public function nightWorkedDays(): float
    {
        return $this->nightWorkedDays * $this->basicSalary();
    }

    public function normalSalary(): float
    {
        return array_sum(array_merge($this->getMethodConcepts(), [
                'mixedWatchExtraTime' => '',
                'nigthWatchExtraTime' => '',
            ])) / array_sum($this->getDivisors()
        );
    }

    public function normalSalaryForRest(): float
    {
        return array_sum($this->getMethodConcepts()) / array_sum($this->getDivisors());
    }

    public function normalSalaryBonusSixthDayWorked(): float
    {
        return array_sum(array_merge($this->getMethodConcepts(), [
                'sixthDayWorkedPremium' => '',
            ])) / array_sum($this->getDivisors()
        );
    }

    public function normalSalaryForNigthBonus(): float
    {
        return array_sum(array_merge($this->getMethodConcepts(), [
                'nightBonus' => ''
            ])) / array_sum($this->getDivisors()
        );
    }

    public function normalSalaryForSundayPremium(): float
    {
        return array_sum(array_merge($this->getMethodConcepts(), [
            'sundayPremium' => ''
        ])) / array_sum($this->getDivisors());
    }

    public function sundayPremium(): float
    {
        return $this->basicSalary() * 1.5;
    }

    public function sixthDayWorkedDay(int $day = 0): float
    {
        return $this->basicSalary() * $day;
    }

    public function sixthDayWorkedMixed(int $day = 0): float
    {
        return $this->basicSalary() * $day;
    }

    public function sixthDayWorkedNigth(int $day = 0): float
    {
        return $this->basicSalary() * $day;
    }

    public function sixthDayWorkedPremium(): float
    {
        return $this->basicSalary() * 1.5;
    }

    public function hoursForNigthBonus(): float
    {
        $this->hoursForNigthBonus =
            (($this->mixedWorkedDays + $this->sixthDayWorkedMixed) * 4) +
            (($this->nightWorkedDays + $this->sixthDayWorkedNigth) * 6);

        return $this->hoursForNigthBonus;
    }

    public function nightBonus(): float
    {
        return ($this->salaryHour() * 0.38) * (
            $this->hoursForNigthBonus +
            $this->nightBonusDayOvertime +
            $this->nightBonusMixedOvertime
        );
    }

    public function mixedWatchExtraTime(): float
    {
        $mixedWatchExtraTime = 0.5 * (
            $this->mixedWorkedDays +
            $this->sixthDayWorkedMixed
        );

        return $this->salaryHour(7.5) * 1.81 * $mixedWatchExtraTime;
    }

    public function nigthWatchExtraTime(float $factor = 1): float
    {
        $nigthWatchExtraTime = $factor * (
            $this->nightWorkedDays +
            $this->sixthDayWorkedNigth
        );

        return $this->salaryHour(7) * 1.81 * $nigthWatchExtraTime;
    }

    protected function basicSalary(): float
    {
        return $this->position->basic_salary;
    }

    protected function salaryHour(float $journal = 8): float
    {
        return $this->basicSalary() / $journal;
    }
}
