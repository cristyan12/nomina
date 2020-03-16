<?php

namespace Tests;

trait TestHelpers
{
    protected $someUser;

    protected function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }

    protected function make($class, $attributes = [])
    {
        return factory($class)->make($attributes);
    }

    protected function someUser(array $attributes = [])
    {
        if ($this->someUser) {
            return $this->someUser;
        }

        return $this->someUser = factory('App\User')->create($attributes);
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

        $nightBonusSB = $this->employee->hoursBonusTravelTimeNight()
            ->hoursForNigthBonus();
    }
}