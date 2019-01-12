<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber,
        'document' => $faker->randomNumber,
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'rif' => $faker->randomNumber,
        'born_at' => $faker->date,
        // 'marital_status' => rand(['Casado/a', 'Soltero/a', 'Viudo/a']),
        'sex' => $faker->randomElement(['F', 'M']),
        // 'nationality' => $faker->randomElement(['V', 'E']),
        'city_of_born' => $faker->city,
        'hired_at' => $faker->date,
        'profession_id' => function () {
        	return rand(1, App\Profession::count());
        },
        'contract_id' => function () {
        	return rand(1, App\Contract::count());
        },
        // 'status' => $faker->word
    ];
});
