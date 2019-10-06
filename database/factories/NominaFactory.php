<?php

use Faker\Generator as Faker;

$factory->define(App\Nomina::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement([
            'Semanal', 'Quincenal', 'Mensual', 'Otros',
        ]),
        'periods' => $faker->randomNumber(2),
        'first_period_at' => $faker->date(),
        'last_period_at' => $faker->date(),
        'user_id' => factory('App\User'),
    ];
});
