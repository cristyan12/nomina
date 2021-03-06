<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait TestHelpers
{
    protected $someUser;

    protected function create(string $class, array $attributes = []): Model
    {
        return $class::factory()->create($attributes);
    }

    protected function make(string $class, array $attributes = []): Model
    {
        return $class::factory()->make($attributes);
    }

    protected function someUser(array $attributes = [])
    {
        if ($this->someUser) {
            return $this->someUser;
        }

        return $this->someUser = User::factory()->create($attributes);
    }

    protected function withData(array $custom = [])
    {
        return array_merge($this->defaultAttributes(), $custom);
    }

    protected function defaultAttributes()
    {
        return $this->attributes;
    }

    protected function prepareParams()
    {
        // Estos valores se basan en los mismos valores que pide
        // la hoja de excel de pruebas que se usa para calcular
        // los diferentes conceptos de la nomina
        $days = $this->employee
            ->setDayWorkedDays(1)
            ->setMixedWorkedDays(2)
            ->setNightWorkedDays(4)
            ->setSixthDayWorked(1);

        $travelTime = $this->employee
            ->setHoursDayTravelTime52(1.50)
            ->setHoursDayTravelTime77(1.50)
            ->setHoursMixedTravelTime52(3)
            ->setHoursMixedTravelTime77(3)
            ->setHoursNigthTravelTime52(6)
            ->setHoursNigthTravelTime77(6);

        $nightBonusSB = $this->employee
            ->hoursBonusTravelTimeNight()
            ->hoursForNigthBonus();
    }
}