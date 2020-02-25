<?php

namespace App;

trait CalculatePay
{
    protected $daysWorked;

    protected $daysWorkedDay;

    protected $mixedDaysWorked;

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

    public function setDaysWorked(int $days): self
    {
        $this->daysWorked = $days;

        return $this;
    }

    public function setDaysWorkedDay(int $days = 0): self
    {
        $this->daysWorkedDay = $days;

        return $this;
    }

    public function setSixthDayWorkedDay(int $day = 0): self
    {
        $this->sixthDayWorkedDay = $day;

        return $this;
    }

    public function setMixedDaysWorked(int $days = 0): self
    {
        $this->mixedDaysWorked = $days;

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

    public function sethoursDayTravelTime52(float $hours): self
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

    public function setHoursBonusTravelTimeNight(): self
    {
        $this->hoursBonusNigthTravelTime =
            (($this->daysWorkedDay + $this->sixthDayWorkedDay) * 0.5) +
            (($this->mixedDaysWorked + $this->sixthDayWorkedMixed) * 1.5) +
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

    public function bonusWorkedInSunday(): float
    {
        // return ($this->daysWorked() + $this->travelTime()) / ($this->daysWorked * 1.5);
    }

    public function sundayPremium(): float
    {
        return $this->basicSalary() * 1.5;
    }

    public function sixthDayWorkedPremium(): float
    {
        return $this->basicSalary() * 1.5;
    }

    public function setHoursForNigthBonus(): float
    {
        $this->hoursForNigthBonus =
            (($this->mixedDaysWorked + $this->sixthDayWorkedMixed) * 4) +
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
            $this->mixedDaysWorked +
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
