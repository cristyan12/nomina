<?php

use App\Nomina;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber,
        'document' => $faker->randomNumber,
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'rif' => $faker->randomNumber,
        'born_at' => $faker->date,
        'civil_status' => $faker->randomElement([
            'Casado/a', 'Soltero/a', 'Divorciado/a', 'Viudo/a'
        ]),
        'sex' => $faker->randomElement(['F', 'M']),
        'nationality' => $faker->randomElement(['V', 'E']),
        'city_of_born' => $faker->city,
        'hired_at' => $faker->date,
        'nomina_id' => factory(Nomina::class),
        'user_id' => factory(User::class),
    ];
});