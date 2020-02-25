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

    public function normalSalaryBonusSixthDayWorked(): float
    {
        // Missing: Pago de comida y ayuda de ciudad.
        // TODO: dd($this->concept);
        dd($this->dayTravelTime52());

        $concepts = [
            $this->dayWorkedDays(), $this->mixedWorkedDays(), $this->nightWorkedDays(),
            $this->dayTravelTime52(), $this->dayTravelTime77(), $this->mixedTravelTime52(),
            $this->mixedTravelTime77(), $this->nigthTravelTime52(), $this->nigthTravelTime77(),
            $this->bonusTravelTimeNight(), $this->sixthDayWorkedDay(), $this->sixthDayWorkedMixed(),
            $this->sixthDayWorkedNigth(), $this->sundayPremium(), $this->nightBonus(),
            $this->mixedWatchExtraTime(), $this->nigthWatchExtraTime(),
        ];

        $divisors = [
            $this->dayWorkedDays, $this->mixedWorkedDays, $this->nightWorkedDays,
            $this->sixthDayWorkedDay, $this->sixthDayWorkedMixed, $this->sixthDayWorkedNigth,
            $this->paidPermit, $this->unexcusedAbsence, $this->unpaidPermit, $this->outpatientDisease,
            $this->occupationalDisease, $this->industrialAccident, $this->unionPermit
        ];

        return array_sum($concepts) / array_sum($divisors);
    }

    public function sundayPremium(): float
    {
        return $this->basicSalary() * 1.5;
    }

    public function sixthDayWorkedDay(): float
    {
        return $this->basicSalary() * 1;
    }

    public function sixthDayWorkedMixed(): float
    {
        return $this->basicSalary() * 1;
    }

    public function sixthDayWorkedNigth(): float
    {
        return $this->basicSalary() * 1;
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
