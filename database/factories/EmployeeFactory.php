<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber,
        'document' => $faker->randomNumber,
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'rif' => $faker->randomNumber,
        'born_at' => $faker->date,
        'sex' => $faker->randomElement(['F', 'M']),
        'nationality' => $faker->randomElement(['V', 'E']),
        'city_of_born' => $faker->city,
        'hired_at' => $faker->date,
        'nomina_id' => rand(1, 5),
        'user_id' => factory('App\User'),
    ];
});