<?php

namespace App;

trait CalculatePay
{
    protected $daysWorked;
    protected $hoursTravelTime;
    protected $travelTime;
    protected $percentsTravelTime = [
        '52' => 1.52,
        '77' => 1.77,
        '38' => 0.38,
        '83' => 1.83,
    ];
    protected $percentTravelTime;

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

    public function setPercentTravelTime($percent): self
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
}
