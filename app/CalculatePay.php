<?php

namespace App;

trait CalculatePay
{
    protected $daysWorked;
    protected $travelTime;
    protected $percentsTravelTime = [
        '52' => 1.52,
        '77' => 1.77,
        '38' => 0.38,
        '83' => 1.83,
    ];
    protected $percentTravelTime;

    public function setDaysWorked(int $days)
    {
        $this->daysWorked = $days;

        return $this;
    }

    public function setPercentTravelTime($percent)
    {
        $this->percentTravelTime = $this->percentsTravelTime[$percent];

        return $this;
    }

    public function daysWorked(): float
    {
        return $this->basicSalary() * $this->daysWorked;
    }

    public function sixthDayWorked(): float
    {
        return $this->basicSalary() * 1;
    }

    public function travelTime(float $hours): float
    {
        return ($this->basicSalary() / 8) * $this->percentTravelTime * $hours;
    }

    public function workedInSunday()
    {
        return $this->daysWorked() + $this->travelTime(3) / $this->daysWorked * 1.5;
    }

    protected function basicSalary(): float
    {
        return $this->position->basic_salary;
    }
}
