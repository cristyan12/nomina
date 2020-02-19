<?php

namespace App;

trait CalculatePay
{
    protected $daysWorked;
    protected $hoursTravelTime;
    protected $percentsTravelTime = [
        '52' => 1.52,
        '77' => 1.77,
        '38' => 0.38,
        '83' => 1.83,
    ];
    protected $percentTravelTime;
    protected $daysWorkedDay;
    protected $mixedDaysWorked;
    protected $sixthDayWorkedDay;
    protected $sixthDayWorkedMixed;
    protected $nightWorkedDays;
    protected $sixthDayWorkedNigth;
    protected $hoursForBonusTravelTimeNigth = 0;

    public function setDaysWorked(int $days): self
    {
        $this->daysWorked = $days;

        return $this;
    }

    public function setHoursTravelTime(int $hours): self
    {
        $this->hoursTravelTime = $hours;

        return $this;
    }

    public function setPercentTravelTime(float $percent): self
    {
        $this->percentTravelTime = $this->percentsTravelTime[$percent];

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

    public function getHoursBonusTravelTimeNight(): float
    {
        $this->hoursForBonusTravelTimeNigth =
            (($this->daysWorkedDay + $this->sixthDayWorkedDay) * 0.5) +
            (($this->mixedDaysWorked + $this->sixthDayWorkedMixed) * 1.5) +
            (($this->nightWorkedDays + $this->sixthDayWorkedNigth) * 1.5);

        return $this->hoursForBonusTravelTimeNigth;
    }

    public function bonusTravelTimeNight(): float
    {
        return $this->salaryHour() * 0.38 * $this->hoursForBonusTravelTimeNigth;
    }

    public function daysWorked(): float
    {
        return $this->basicSalary() * $this->daysWorked;
    }

    public function sixthDayWorked(): float
    {
        return $this->basicSalary() * 1;
    }

    public function travelTime(): float
    {
        return ($this->basicSalary() / 8) * $this->percentTravelTime * $this->hoursTravelTime;
    }

    public function workedInSunday(): float
    {
        return ($this->daysWorked() + $this->travelTime()) / $this->daysWorked * 1.5;
    }

    protected function basicSalary(): float
    {
        return $this->position->basic_salary;
    }

    protected function salaryHour(float $journal = 8)
    {
        return $this->basicSalary() / $journal;
    }
}
