<?php

namespace App;

trait CalculatePay
{
    public function daysWorked(int $days): float
    {
        return $this->position->basic_salary * $days;
    }

    public function sixthDayWorked(): float
    {
        return $this->position->basic_salary * 1;
    }
}
