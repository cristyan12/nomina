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
        'city_of_born' => $faker->city,
        'hired_at' => $faker->date,
        'user_id' => factory('App\User')->create()->id,
    ];
});